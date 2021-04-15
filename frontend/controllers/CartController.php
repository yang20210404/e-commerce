<?php
namespace frontend\controllers;

use common\models\CartItem;
use common\models\Order;
use common\models\Product;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\filters\ContentNegotiator;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\web\Response;


/**
 * Site controller
 */
class CartController extends \frontend\base\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['add'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index', 'change-quantity', 'delete', 'checkout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            [
                'class' => ContentNegotiator::class,
                'only' => ['add', 'change-quantity'],
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
            [
                'class' => VerbFilter::class,
                'actions' => [
                    'index' => ['GET'],
                    'add' => ['POST'],
                    'delete' => ['DELETE'],
                    'change-quantity' => ['POST'],
                    'checkout' => ['POST']
                ]
            ]
        ];
    }

    public function beforeAction($action)
    {
        $this->view->params['cartItemCount'] = \common\models\CartItem::getTotalQuantity(\Yii::$app->user->id);

        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $userId = \Yii::$app->user->id;

        $cartItems = CartItem::getItemsFromUser($userId);
        $totalPriceFromUser = CartItem::getTotalPriceFormUser($userId);

        return $this->render('index', [
            'items' => $cartItems,
            'totalPriceFromUser' => $totalPriceFromUser
        ]);
    }

    public function actionAdd()
    {
        if (\Yii::$app->user->isGuest) {
            return ['success' => false];
        } else {
            $id = \Yii::$app->request->post('id');
            $userId = \Yii::$app->user->id;
            $cartItem = CartItem::find()->andWhere([
                'created_by' => $userId,
                'product_id' => $id
            ])->one();

            if ($cartItem) {
                $cartItem->quantity++;
            } else {
                $cartItem = new CartItem();
                $cartItem->product_id = $id;
                $cartItem->quantity = 1;
            }

            $cartItem->save();

            return ['success' => true];
        }
    }

    public function actionChangeQuantity()
    {
        $id = \Yii::$app->request->post('id');
        $quantity = \Yii::$app->request->post('quantity');
        $product = Product::findOne($id);
        $userId = \Yii::$app->user->id;

        if (!$product) {
            throw new NotFoundHttpException("商品不存在");
        }

        $cartItem = CartItem::find()->andWhere([
            'created_by' => $userId,
            'product_id' => $id
        ])->one();

        if ($cartItem) {
            $cartItem->quantity = $quantity;
            $cartItem->save();
        }

        return [
            'quantity' => CartItem::getTotalQuantity($userId),
            'totalPriceFromItem' => \Yii::$app->formatter->asCurrency(CartItem::getTotalPriceFormItem($id, $userId)),
            'totalPriceFromUser' => \Yii::$app->formatter->asCurrency(CartItem::getTotalPriceFormUser($userId)),
        ];
    }

    public function actionDelete($id = null){
        $userId = \Yii::$app->user->id;

        if ($id) {
            CartItem::deleteAll([
                'product_id' => $id,
                'created_by' => $userId
            ]);
        } else {
            CartItem::deleteAll(['created_by' => $userId]);
        }

        return $this->redirect(['index']);
    }

    public function actionCheckout()
    {
        $userId = \Yii::$app->user->id;

        $cartItems = CartItem::getItemsFromUser($userId);

        if ($cartItems) {
            $order = new Order();
            $order->username = \Yii::$app->user->identity->username;
            $order->total_price = CartItem::getTotalPriceFormUser($userId);
            $order->status = Order::STATUS_DRAFT;
            $order->save();
            $order->saveOrderItems($userId);

            CartItem::deleteAll();

            \Yii::$app->session->setFlash('success', '訂單已成立！！ 請付款');

            return $this->redirect(['/order/index']);
        }
    }
}

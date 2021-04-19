<?php

namespace frontend\controllers;

use common\models\CashFlow;
use common\models\OrderItem;
use Yii;
use common\models\Order;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends \frontend\base\Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'detail', 'pay'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['GET'],
                    'detail' => ['GET'],
                    'pay' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = Order::find()
            ->andWhere(['created_by' => Yii::$app->user->id])
            ->orderBy('created_at DESC');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDetail($id)
    {
        $query = OrderItem::find()->andWhere(['order_id' => $id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('detail', [
            'dataProvider' => $dataProvider,
            'order_id' => $id,
        ]);
    }

    public function actionPay()
    {
        $id = Yii::$app->request->post('id');

        $cashFlow = new CashFlow();
        if ($cashFlow->pay($id)) {
            return $cashFlow->pay($id);
        }
    }
}

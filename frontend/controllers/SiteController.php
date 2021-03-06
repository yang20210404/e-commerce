<?php
namespace frontend\controllers;

use common\models\Category;
use common\models\Product;
use common\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\ContentNegotiator;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use yii\web\NotFoundHttpException;
use yii\web\Response;


/**
 * Site controller
 */
class SiteController extends \frontend\base\Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['signup', 'login', 'index', 'detail', 'logout', 'profile', 'reset-password'],
                'rules' => [
                    [
                        'actions' => ['signup', 'login', 'index', 'detail'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'profile', 'reset-password'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            [
                'class' => ContentNegotiator::class,
                'only' => ['reset-password'],
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['GET'],
                    'login' => ['GET', 'POST'],
                    'logout' => ['POST'],
                    'signup' => ['GET', 'POST'],
                    'detail' => ['GET'],
                    'profile' => ['GET', 'POST'],
                    'reset-password' => ['POST']
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex($category_id = null)
    {
        if ($category_id) {
            $dataProvider = new ActiveDataProvider([
                'query' => Product::find()->andWhere([
                    'status' => Product::STATUS_ACTIVE,
                    'is_delete' => Product::NOT_DELETE,
                    'category_id' => $category_id
                ]),
                'pagination' => [
                    'pageSize' => 6,
                ],
            ]);
        } else {
            $dataProvider = new ActiveDataProvider([
                'query' => Product::find()->andWhere([
                    'status' => Product::STATUS_ACTIVE,
                    'is_delete' => Product::NOT_DELETE
                ]),
                'pagination' => [
                    'pageSize' => 6,
                ],
            ]);
        }

        $categories = Category::find()->all();

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'categories' => $categories
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $user = Yii::$app->user->identity;
            $user->last_login_at = date('Y-m-d H:i:s', time());
            $user->save();
            if ($user->admin) {
                Yii::$app->session->setFlash('success', '(??????) ????????????????????????');
            }

            return $this->goHome();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', '?????????????????? ?????????');
            return $this->redirect(['login']);
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionDetail($id)
    {
        return $this->render('detail', [
            'model' => $this->findModel($id)
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword()
    {
        $model = new ResetPasswordForm();

        if ($model->load(['ResetPasswordForm' => Yii::$app->request->post()]) && $model->validatePassword()) {
            if ($model->validate() && $model->resetPassword()) {
                Yii::$app->session->setFlash('success', '???????????????????????? ???????????????');

                return $this->redirect(['profile']);
            }
        } else {
            $model->addError('old_password', '???????????????');
        }

        return $model->errors;
    }

    public function actionProfile()
    {
        $user = User::findOne(Yii::$app->user->id);
        $model = new ResetPasswordForm();

        if ($user->load(Yii::$app->request->post()) && $user->save()) {
            Yii::$app->session->setFlash('success', '????????????????????????');

            return $this->redirect(['profile']);
        }

        return $this->render('profile', [
           'user' =>$user,
            'model' => $model
        ]);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('???????????????');
    }
}

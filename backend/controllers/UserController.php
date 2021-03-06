<?php

namespace backend\controllers;

use common\models\CashFlow;
use Yii;
use common\models\User;
use backend\models\search\UserSearch;
use yii\filters\AccessControl;
use yii\filters\ContentNegotiator;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
                        'actions' => ['index', 'update', 'active', 'block', 'deposit'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['GET'],
                    'update' => ['GET', 'POST'],
                    'active' => ['POST'],
                    'block' => ['POST'],
                    'deposit' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $user = $this->findModel($id);
        $model = new CashFlow();

        if ($user->load(Yii::$app->request->post()) && $user->save()) {
            Yii::$app->session->setFlash('success', '??????????????????????????????');

            return $this->redirect(['index']);
        }

        if ($model->load(Yii::$app->request->post()) && $model->deposit()) {
            Yii::$app->session->setFlash('success', '??????????????????');

            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'user' => $user,
            'model' => $model
        ]);
    }

    public function actionActive()
    {
        $id = Yii::$app->request->post('id');

        $user = User::findOne(['id' => $id]);
        $user->status = User::STATUS_ACTIVE;
        $user->save();
    }

    public function actionBlock()
    {
        $id = Yii::$app->request->post('id');

        $user = User::findOne(['id' => $id]);
        $user->status = User::STATUS_INACTIVE;
        $user->save();
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('??????????????????');
    }
}

<?php

namespace frontend\controllers;

use Yii;
use common\models\CashFlow;
use frontend\models\search\CashFlowSearch;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * CashFlowController implements the CRUD actions for CashFlow model.
 */
class CashFlowController extends \frontend\base\Controller
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
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['GET'],
                ],
            ],
        ];
    }

    /**
     * Lists all CashFlow models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = CashFlow::find()
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
}

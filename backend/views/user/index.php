<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '用戶列表';
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pager' => [
            'class' => \yii\bootstrap4\LinkPager::class
        ],
        'columns' => [
            [
                'attribute' => 'id',
                'contentOptions' => [
                    'style' => 'width: 10px; vertical-align: middle; font-weight: bold;',
                    'align' => 'center'
                ]
            ],
            [
                'attribute' => 'username',
                'contentOptions' => [
                    'style' => 'width: 90px; vertical-align: middle',
                    'align' => 'center'
                ]
            ],
            [
                'attribute' => 'balance',
                'format' => 'currency',
                'contentOptions' => [
                    'style' => 'width: 90px; vertical-align: middle',
                    'align' => 'center'
                ]
            ],
            [
                'attribute' => 'created_at',
                'format' => 'datetime',
                'contentOptions' => [
                    'style' => 'width: 10px; vertical-align: middle; white-space: nowrap;',
                    'align' => 'center'
                ]
            ],            [
                'attribute' => 'last_login_at',
                'format' => 'datetime',
                'contentOptions' => [
                    'style' => 'width: 10px; vertical-align: middle; white-space: nowrap;',
                    'align' => 'center'
                ]
            ],
            [
                'attribute' => 'status',
                'filter' => Html::activeDropDownList($searchModel, 'status', \common\models\User::getStatusLabels(), [
                    'prompt' => '全部',
                    'class' => 'form-control'
                ]),
                'format' => 'userStatus',
                'contentOptions' => [
                    'style' => 'width: 90px; vertical-align: middle',
                    'align' => 'center'
                ]
            ],
            [
                'content' => fn($model) => Html::a('編輯/充值', \yii\helpers\Url::to(['/user/update', 'id' => $model->id]), [
                    'class' => 'btn btn-primary btn-sm',
                ]),
                'contentOptions' => [
                    'style' => 'width: 90px; vertical-align: middle',
                    'align' => 'center'
                ]
            ],
        ],
    ]); ?>

</div>
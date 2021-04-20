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
                    'style' => 'width: 90px; vertical-align: middle',
                    'align' => 'center'
                ]
            ],            [
                'attribute' => 'last_login_at',
                'format' => 'datetime',
                'contentOptions' => [
                    'style' => 'width: 90px; vertical-align: middle',
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
1618822278-8F157E583F-Gd-8960376.jpeg
1618822322-55350E7C67-Gd-9244150.jpeg
1618822340-F30629149C-SP-8922617.jpeg
1618888340-C6AB6B170435B50E73AF1D4D7F3A843DEE30EDD2.jpeg
1618888391-EF4CA557BF-SP-6408219.jpeg
1618888431-29003543817D23D3FFE515B77ACA8C39916989E6.jpeg
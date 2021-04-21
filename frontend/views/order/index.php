<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '訂單';
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
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
                'attribute' => 'total_price',
                'format' => 'currency',
                'contentOptions' => [
                    'style' => 'width: 90px',
                    'align' => 'center'
                ]
            ],
            [
                'attribute' => 'created_at',
                'format' => 'datetime',
                'contentOptions' => [
                    'style' => 'width: 30px',
                    'align' => 'center'
                ]
            ],
            [
                'attribute' => 'status',
                'format' => 'orderStatusForFrontend',
                'contentOptions' => [
                    'style' => 'width: 30px',
                    'align' => 'center'
                ]
            ],
            [
                'content' => function($model) {
                    return Html::a('查看詳細', \yii\helpers\Url::to(['/order/detail', 'id' => $model->id]), [
                        'class' => 'btn btn-secondary btn-sm'
                    ]);
                },
                'contentOptions' => [
                    'style' => 'width: 90px',
                    'align' => 'center'
                ]
            ]
        ],
    ]); ?>


</div>

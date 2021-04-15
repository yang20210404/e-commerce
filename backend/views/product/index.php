<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '商品列表';
?>
<div class="product-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('新增商品', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'image',
                'content' => fn($model) => Html::img($model->getImageUrl(), ['style' => 'width: 80px']),
                'contentOptions' => ['style' => 'padding: 1px; width: 81px']
            ],
            [
                'attribute' => 'name',
                'contentOptions' => ['style' => 'word-break: break-all']
            ],
            [
                'attribute' => 'price',
                'format' => ['currency'],
                'contentOptions' => [
                    'style' => 'width: 120px',
                    'align' => 'center'
                ]
            ],
            [
                'attribute' => 'status',
                'format' => 'productStatus',
                'contentOptions' => [
                    'style' => 'width: 10px',
                    'align' => 'center'
                ]
            ],
            [
                'attribute' => 'created_at',
                'format' => ['datetime'],
                'contentOptions' => ['style' => 'white-space: nowrap; width: 100px']
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['datetime'],
                'contentOptions' => ['style' => 'white-space: nowrap; width: 100px']
            ],
            [
                'content' => function ($model) {
                    return Html::a('查看', \yii\helpers\Url::to(['/product/view', 'id' => $model->id]), [
                            'class' => 'btn btn-success btn-sm'
                    ]);
                },
                'contentOptions' => ['align' => 'center']
            ],
        ],
    ]); ?>


</div>

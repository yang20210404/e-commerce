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
        'pager' => [
            'class' => \yii\bootstrap4\LinkPager::class
        ],
        'columns' => [
            [
                'attribute' => 'id',
                'contentOptions' => [
                    'style' => 'width: 10px; font-weight: bold; vertical-align: middle;',
                    'align' => 'center'
                ]
            ],
            [
                'attribute' => 'image',
                'content' => function($model) {
                    return Html::img($model->getImageUrl(), ['style' => 'width: 100px']);
                },
                'contentOptions' => ['style' => 'padding: 1px; width: 81px']
            ],
            [
                'attribute' => 'name',
                'content' => function($model) {
                    return \yii\helpers\BaseStringHelper::truncate($model->name, 70);
                },
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
                'filter' => Html::activeDropDownList($searchModel, 'status', \common\models\Product::getStatusLabels(), [
                    'prompt' => '全部',
                    'class' => 'form-control'
                ]),
                'format' => 'productStatus',
                'contentOptions' => [
                    'style' => 'width: 110px',
                    'align' => 'center'
                ]
            ],
            [
                'attribute' => 'created_at',
                'filter' => \kartik\daterange\DateRangePicker::widget([
                    'model'=>$searchModel,
                    'attribute'=>'created_at',
                    'convertFormat'=>true,
                    'pluginOptions'=>[
                        'locale'=>[
                            'format'=>'Y-m-d'
                        ]
                    ]
                ]),
                'format' => ['datetime'],
                'contentOptions' => ['style' => 'white-space: nowrap; width: 100px']
            ],
            [
                'attribute' => 'updated_at',
                'filter' => \kartik\daterange\DateRangePicker::widget([
                    'model'=>$searchModel,
                    'attribute'=>'updated_at',
                    'convertFormat'=>true,
                    'pluginOptions'=>[
                        'locale'=>[
                            'format'=>'Y-m-d'
                        ]
                    ]
                ]),
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

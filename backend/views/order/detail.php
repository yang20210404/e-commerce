<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Order */

$this->title = '訂單編號'
?>
<div class="order-detail">
    <a href="<?= \yii\helpers\Url::to(['order/index']) ?>" class="btn-primary btn">上一頁</a>
    <h1><?= Html::encode($this->title . ' # ' . $order_id) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'options' => ['style' => 'table-layout:fixed;'],
        'columns' => [
            [
                'attribute' => 'product_id',
                'contentOptions' => [
                    'style' => 'width: 85px; font-weight: bold; vertical-align: middle;',
                    'align' => 'center'
                ]
            ],
            [
                'attribute' => 'image',
                'content' => function($model) {
                    return Html::img($model->product->getImageUrl(), ['width' => '100px']);
                },
                'contentOptions' => ['style' => 'width:100px; padding: 1px;']
            ],
            [
                'attribute' => 'product_name',
                'content' => function($model) {
                    return Html::a(
                            \yii\helpers\BaseStringHelper::truncate($model->product_name, 100),
                            \yii\helpers\Url::to(['/product/view', 'id' => $model->product_id])
                    );
                },
                'contentOptions' => ['style' => 'word-break: break-all; width:590px;']
            ],
            [
                'attribute' => 'product_price',
                'format' => 'currency',
                'contentOptions' => [
                    'style' => 'width:200px;',
                    'align' => 'center'
                ]
            ],
            [
                'attribute' => 'quantity',
                'contentOptions' => [
                    'style' => 'width:200px;',
                    'align' => 'center'
                ]
            ],
        ],
    ]); ?>
</div>

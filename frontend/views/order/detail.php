<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '訂單編號';
?>
<div class="order-detail">
    <a href="<?= \yii\helpers\Url::to(['order/index']) ?>" class="btn-primary btn">上一頁</a>
    <h1><?= Html::encode($this->title . ' # ' . $order_id) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'options' => ['style' => 'table-layout:fixed;'],
        'columns' => [
            [
                'attribute' => 'image',
                'content' => fn($model) => Html::img($model->product->getImageUrl(), ['width' => '108px']),
                'contentOptions' => ['style' => 'width:100px; padding: 1px;']
            ],
            [
                'attribute' => 'product_name',
                'contentOptions' => ['style' => 'word-break: break-all; width:590px;']
            ],
            [
                'attribute' => 'product_price',
                'format' => 'currency',
                'contentOptions' => ['style' => 'width:200px;']
            ],
            [
                'attribute' => 'quantity',
                'contentOptions' => ['style' => 'width:200px;']
            ],
        ],
    ]); ?>
</div>

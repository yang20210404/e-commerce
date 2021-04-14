<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model->name;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view product-item" data-key="<?= $model->id ?>">

    <h1><?= Html::encode($this->title) ?></h1>
    <div>
        <img src="<?= $model->getImageUrl() ?>" style="width: 600px; margin: 40px 0;">
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'description',
                'format' => ['html'],
                'value' => $model->description,
                'contentOptions' => ['style' => 'word-break: break-all']
            ],
            'price:currency',
        ],
    ]) ?>

    <div class="text-right">
        <a href="<?php echo \yii\helpers\Url::to(['/cart/add']) ?>" class="btn btn-primary btn-add-to-cart">
            加入購物車
        </a>
    </div>

</div>

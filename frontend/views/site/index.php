<?php

/* @var $this yii\web\View */

$this->title = '購物商城';
?>
<div class="site-index">
    <?= \yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
        'layout' => '{summary}<div class="row">{items}</div>',
        'itemView' => '_product_item',
        'itemOptions' => [
            'class' => 'col-lg-4 col-md-6 mb-4 product-item'
        ],
    ]);
    ?>
</div>

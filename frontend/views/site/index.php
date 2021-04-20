<?php

/* @var $this yii\web\View */

$this->title = '購物商城';
?>
<div class="site-index">
    <div style="float: right;">
        <?php
        Yii::$app->params['bsDependencyEnabled'] = false;
        Yii::$app->params['bsVersion'] = '4.x';

        $sideNavItems = [];
        $sideNavItems[] =  ['label' => ''. '全部商品', 'url' => \yii\helpers\Url::to(['/site/index'])];
        foreach ($categories as $category) {
            $sideNavItems[] =  ['label' => ''. $category->name, 'url' => \yii\helpers\Url::to(['/site/index', 'category_id' => $category->id])];
        }

        $type = \kartik\sidenav\SideNav::TYPE_PRIMARY;
        $heading = '商品類別';

        echo \kartik\sidenav\SideNav::widget([
            'type' => $type,
            'encodeLabels' => false,
            'heading' => $heading,
            'items' =>$sideNavItems,
        ]);
        ?>
    </div>

    <h1>商品列表</h1>

    <?= \yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
        'layout' => '{summary}<div class="row">{items}</div><div class="row justify-content-center">{pager}</div>',
        'pager' => [
            'class' => \yii\bootstrap4\LinkPager::class
        ],
        'itemView' => '_product_item',
        'itemOptions' => [
            'class' => 'col-lg-4 col-md-6 mb-4 product-item'
        ],
    ]);
    ?>

</div>

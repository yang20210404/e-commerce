<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

if (!Yii::$app->user->isGuest) {
    $cartItemCount = $this->params['cartItemCount'];
    $balance = $this->params['balance'];
}

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl
    ]);

    if (Yii::$app->user->isGuest) {
        $menuItems = [
            ['label' => '註冊', 'url' => ['/site/signup']],
            ['label' => '登入', 'url' => ['/site/login']],
        ];
    } else {
        $menuItems = [
            [
                'label' => '餘額：' . $balance,
                'url' => ['#'],
                'linkOptions' => [
                        'style' => 'color: blue; font-weight: bold;'
                ]
            ],
            [
                'label' => '購物車 <span id="cart-quantity" class="badge badge-danger">' . $cartItemCount . '</span>',
                'url' => ['/cart/index'],
                'encode' => false
            ],
            ['label' => '訂單', 'url' => ['/order/index']],
            ['label' => '流水', 'url' => ['/cash-flow/index']],
            ['label' => '個人資料', 'url' => ['/site/profile']],
            ['label' => '|'],
            [
                'label' => '登出 (' . Yii::$app->user->identity->username . ')',
                'url' => ['/site/logout'],
                'linkOptions' => [
                    'data-method' => 'POST',
                ]
            ],
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ml-auto'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

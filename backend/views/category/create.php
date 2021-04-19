<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = '建立 商品類別';
?>
<div class="category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

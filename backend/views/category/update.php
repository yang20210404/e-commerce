<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = '編輯 商品類別';
?>
<div class="category-update">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('刪除此商品類別', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '確定要移除嗎？',
                'method' => 'DELETE',
            ],
        ]) ?>
    </p>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

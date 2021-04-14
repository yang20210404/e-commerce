<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = '編輯管理員  ID# ' . $model->id;
?>
<div class="user-update">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('移除管理員身份', ['delete', 'id' => $model->id], [
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

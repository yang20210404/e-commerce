<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */
/* @var $model common\models\CashFlow */

$this->title = '編輯用戶  ID# ' . $user->id;
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'user' => $user,
        'model' => $model
    ]) ?>

</div>

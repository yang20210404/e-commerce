<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $user common\models\User */
/* @var $model common\models\CashFlow */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($user, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($user, 'status')->dropDownList(\common\models\User::getStatusLabels()) ?>

    <?= $form->field($user, 'admin')->checkbox() ?>

    <div class="form-group" style="float: left; margin-right: 7px;">
        <?= Html::submitButton('更新', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php \yii\bootstrap4\Modal::begin([
        'title' => '充值',
        'toggleButton' => [
            'label' => '充值',
            'class' => 'btn btn-success btn-reset-password-modal',
        ]
    ]); ?>
        <?php $form = \yii\bootstrap4\ActiveForm::begin(); ?>
            <?php $model->created_by = $user->id; ?>
            <?= $form->field($model, 'money')->textInput() ?>
            <?= $form->field($model, 'created_by')->hiddenInput()->label(false) ?>

            <div class="form-group">
                <?= Html::submitButton('確認', ['class' => 'btn btn-primary']) ?>


            </div>
        <?php \yii\bootstrap4\ActiveForm::end(); ?>
    <?php \yii\bootstrap4\Modal::end();  ?>

</div>

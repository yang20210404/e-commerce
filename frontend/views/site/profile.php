<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = '個人資料';
?>

<div class="site-login">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <h1><?= Html::encode($this->title) ?></h1>

            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <?= $form->field($user, 'username')->textInput(['autofocus' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton('儲存', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                <?php
                \yii\bootstrap4\Modal::begin([
                    'title' => '重設密碼',
                    'toggleButton' => [
                        'label' => '重設密碼',
                        'class' => 'btn btn-success'
                    ]
                ]); ?>

                <?php $form = \yii\bootstrap4\ActiveForm::begin(); ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'password_repeat')->passwordInput() ?>
                <div class="form-group">
                    <?= Html::submitButton('確認', ['class' => 'btn btn-success']) ?>
                </div>
                <?php \yii\bootstrap4\ActiveForm::end(); ?>
                <?php \yii\bootstrap4\Modal::end();  ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>

    </div>
</div>
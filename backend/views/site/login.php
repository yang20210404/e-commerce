<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = '登入';
?>
<div class="site-login">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <h1><?= Html::encode($this->title) ?></h1>

            <p>請填寫以下資料進行登入:</p>

            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'options' => ['class' => 'user']
            ]); ?>

                <?= $form->field($model, 'username', [
                    'inputOptions' => [
                        'placeholder' => '請輸入用戶名'
                    ]
                ])->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password', [
                    'inputOptions' => [
                        'placeholder' => '請輸入密碼'
                    ]
                ])->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div class="form-group">
                    <?= Html::submitButton('登入', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
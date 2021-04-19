<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->name ? '儲存' : '新增', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '管理員列表';
?>
<div class="user-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pager' => ['class' => \yii\bootstrap4\LinkPager::class],
        'columns' => [
            [
                'attribute' => 'id',
                'contentOptions' => [
                    'style' => 'width: 90px; vertical-align: middle',
                    'align' => 'center'
                ]
            ],
            [
                'label' => '名字',
                'attribute' => 'username',
                'contentOptions' => [
                    'style' => 'width: 90px; vertical-align: middle',
                    'align' => 'center'
                ]
            ],
            [
                'content' => fn($model) => Html::a('編輯/移除', \yii\helpers\Url::to(['/admin/update', 'id' => $model->id]), [
                    'class' => 'btn btn-primary btn-sm',
                ]),
                'contentOptions' => [
                    'style' => 'width: 90px; vertical-align: middle',
                    'align' => 'center'
                ]
            ],
        ],
    ]); ?>

    <?php
    \yii\bootstrap4\Modal::begin([
        'title' => '添加管理員',
        'toggleButton' => [
            'label' => '添加管理員',
            'class' => 'btn btn-success'
        ]
    ]); ?>
    <h6>所有用戶(包含被凍結之用戶)</h6>

        <?php $form = \yii\bootstrap4\ActiveForm::begin(); ?>
            <?php foreach ($users as $user): ?>
                <div>
                    <input type="checkbox" id="<?= $user->id ?>" value="<?= $user->id ?>" name="<?= $user->id ?>">
                    <label for="<?= $user->id ?>"><?= $user->username ?></label>
                </div>
            <?php endforeach; ?>

            <div class="form-group" style="margin-top: 15px;">
                <?= Html::submitButton('添加', ['class' => 'btn btn-primary']) ?>
            </div>
        <?php \yii\bootstrap4\ActiveForm::end(); ?>
    <?php \yii\bootstrap4\Modal::end();  ?>



</div>

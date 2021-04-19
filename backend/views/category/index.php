<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '商品類別';
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    \yii\bootstrap4\Modal::begin([
        'title' => '建立類別',
        'toggleButton' => [
            'label' => '建立類別',
            'class' => 'btn btn-success',
            'style' => 'margin-bottom: 16px;'
        ]
    ]); ?>
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    <?php \yii\bootstrap4\Modal::end();  ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pager' => [
            'class' => \yii\bootstrap4\LinkPager::class
        ],
        'columns' => [
            [
                'attribute' => 'id',
                'contentOptions' => [
                    'style' => 'width: 10%; vertical-align: middle; font-weight: bold;',
                    'align' => 'center'
                ]
            ],
            [
                'attribute' => 'name',
                'contentOptions' => [
                    'style' => 'width: 85%; vertical-align: middle',
                    'align' => 'center'
                ]
            ],
            [
                'content' => fn($model) => Html::a('編輯', \yii\helpers\Url::to(['/category/update', 'id' => $model->id]), [
                    'class' => 'btn btn-primary btn-sm btn-update-category',
                ]),
                'contentOptions' => [
                    'style' => 'width: 5%; vertical-align: middle',
                    'align' => 'center'
                ]
            ]
        ],
    ]); ?>




</div>
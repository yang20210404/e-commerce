<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '資金流水';
?>
<div class="cash-flow-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'options' => ['style' => 'table-layout: fixed;'],
        'pager' => [
            'class' => \yii\bootstrap4\LinkPager::class,
            'options' => ['class' => 'row justify-content-center']
        ],
        'columns' => [
            [
                'attribute' => 'created_at',
                'format' => 'datetime',
                'contentOptions' => [
                    'style' => 'width: 10px; white-space: nowrap;',
                    'align' => 'center'
                ]
            ],
            [
                'attribute' => 'money',
                'format' => 'currency',
                'contentOptions' => [
                    'style' => 'width: 200px;',
                    'align' => 'center'
                ]
            ],
            [
                'attribute' => 'type',
                'format' => 'cashFlowType',
                'contentOptions' => [
                    'style' => 'width: 150px;',
                    'align' => 'center'
                ]
            ],
            [
                'attribute' => 'description',
                'format' => 'html',
                'contentOptions' => [
                    'style' => 'word-break: break-all;',
                ]
            ],
        ],
    ]); ?>


</div>

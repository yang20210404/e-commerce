<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model->name;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('編輯', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('刪除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '確定要刪除嗎？',
                'method' => 'DELETE',
            ],
        ]) ?>
    </p>

    <div>
        <img src="<?= $model->getImageUrl() ?>" style="width: 600px; margin: 40px 0;">
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'description',
                'format' => ['html'],
                'value' => $model->description,
                'contentOptions' => ['style' => 'word-break: break-all']
            ],
            'price:currency',
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => fn() => Html::tag('span', $model->status ? '上架中' : '下架', [
                    'class' => $model->status ? 'badge badge-success' : 'badge badge-danger'
                ]),
            ],
            'created_at:datetime',
            'updated_at:datetime',
            'createdBy.username',
            'updatedBy.username',
        ],
    ]) ?>

</div>

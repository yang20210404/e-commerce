<div class="card h-100">
    <div style="height: 340px; display: flex; align-items: center;">
    <a href="<?= \yii\helpers\Url::to(['site/detail', 'id' => $model->id]) ?>" class="img-wrapper">
        <img class="card-img-top" style="padding: 7px;" src="<?= $model->getImageUrl() ?>">
    </a>
    </div>
    <div class="card-body">
        <h5 class="card-title" style="height: 50px;">
            <a href="<?= \yii\helpers\Url::to(['site/detail', 'id' => $model->id]) ?>" class=""><?= \yii\helpers\BaseStringHelper::truncate($model->name, 30) ?></a>
        </h5>
        <h5><?php echo Yii::$app->formatter->asCurrency($model->price) ?></h5>
    </div>
    <div class="card-footer text-right">
        <a href="<?= \yii\helpers\Url::to(['/cart/add']) ?>" class="btn btn-primary btn-add-to-cart">
            加入購物車
        </a>
    </div>
</div>
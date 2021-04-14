<?php
/* @var $this yii\web\View */

$this->title = '購物車';
?>

<div class="card">
    <div class="card-header">
        <h3>購物清單</h3>
    </div>
    <div class="card-body p-0">
        <?php if (!empty($items)): ?>
            <table class="table table-hover" style="margin-bottom: 0px;">
                <thead>
                <tr>
                    <th width="10%"></th>
                    <th width="40%">名稱</th>
                    <th width="10%">單價</th>
                    <th width="10%">數量</th>
                    <th width="10%">小計</th>
                    <th width="10%">動作</th>
                </tr>
                </thead>

                <tbody>
                    <?php foreach ($items as $item): ?>
                        <tr data-id="<?= $item['id'] ?>" data-url="<?= \yii\helpers\Url::to(['/cart/change-quantity']) ?>">
                            <td>
                                <img src="<?= 'http://127.0.0.1/e-commerce/frontend/web/storage' . $item['image'] ?>"
                                     style="width: 120px;"
                                     alt="<?= $item['name'] ?>">
                            </td>
                            <td style="word-break: break-all;"><?= $item['name'] ?></td>
                            <td><?= Yii::$app->formatter->asCurrency($item['price']) ?></td>
                            <td>
                                <input type="number" min="1" class="form-control item-quantity" style="width: 60px" value="<?= $item['quantity'] ?>">
                            </td>
                            <td><?= Yii::$app->formatter->asCurrency($item['total_price']) ?></td>
                            <td>
                                <?= \yii\helpers\Html::a('移除', ['/cart/delete', 'id' => $item['id']], [
                                    'class' => 'btn btn-outline-danger btn-sm',
                                    'data-method' => 'delete',
                                    'data-confirm' => '確定要刪除嗎?'
                                ]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr class="text-right">
                        <td colspan="6">
                            <h5 class="total-price">總計：<?= Yii::$app->formatter->asCurrency($totalPriceFromUser) ?></h5>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="card-body text-right" style="padding-top: 0px;">
                <?= \yii\helpers\Html::a('結帳', ['/cart/checkout'], [
                    'class' => 'btn btn-secondary',
                    'data-method' => 'POST',
                    'data-confirm' => '確定要結帳嗎?'
                ]) ?>
            </div>
        <?php else: ?>
            <p class="text-muted text-center p-5">購物車內沒有商品！</p>
        <?php endif; ?>

    </div>
</div>
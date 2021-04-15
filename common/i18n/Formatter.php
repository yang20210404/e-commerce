<?php

namespace common\i18n;

use yii\helpers\Html;

/**
 * Class Formatter
 *
 * @package common\i18n
 */
class Formatter extends \yii\i18n\Formatter
{
    public function asOrderStatusForBackend($status)
    {
        if ($status == \common\models\Order::STATUS_PAID) {
            return \yii\bootstrap4\Html::tag('span', '已付款', ['class' => 'badge badge-success'])
                . '<br>' .
                Html::a('退款', \yii\helpers\Url::to(['/order/refund']), [
                    'class' => 'btn btn-outline-success btn-sm btn-order-refund'
                ]);
        } else if ($status == \common\models\Order::STATUS_DRAFT) {
            return \yii\bootstrap4\Html::tag('span', '未付款', ['class' => 'badge badge-danger']);
        } else if ($status == \common\models\Order::STATUS_REFUND) {
            return \yii\bootstrap4\Html::tag('span', '已退款', ['class' => 'badge badge-secondary']);
        }
    }

    public function asOrderStatusForFrontend($status)
    {
        if ($status == \common\models\Order::STATUS_PAID) {
            return \yii\bootstrap4\Html::tag('span', '已付款', ['class' => 'badge badge-success']);
        } else if ($status == \common\models\Order::STATUS_DRAFT) {
            return \yii\bootstrap4\Html::tag('span', '未付款', ['class' => 'badge badge-danger'])
                . '<br>' .
                Html::a('付款', \yii\helpers\Url::to(['/order/pay']), [
                    'class' => 'btn btn-outline-success btn-sm btn-order-pay'
                ]);
        } else if ($status == \common\models\Order::STATUS_REFUND) {
            return \yii\bootstrap4\Html::tag('span', '已退款', ['class' => 'badge badge-secondary']);
        }
    }

    public function asUserStatus($status)
    {
        if ($status == \common\models\User::STATUS_ACTIVE) {
            return \yii\bootstrap4\Html::tag('span', '正常', ['class' => 'badge badge-success'])
                . '<br>' .
                Html::a('凍結', \yii\helpers\Url::to(['/user/block']), [
                    'class' => 'btn btn-outline-danger btn-sm btn-user-block'
                ]);
        } else {
            return \yii\bootstrap4\Html::tag('span', '凍結中', ['class' => 'badge badge-danger'])
                . '<br>' .
                Html::a('激活', \yii\helpers\Url::to(['/user/active']), [
                    'class' => 'btn btn-outline-success btn-sm btn-user-active'
                ]);
        }
    }

    public function asProductStatus($status)
    {
        if ($status == \common\models\Product::STATUS_ACTIVE) {
            return \yii\bootstrap4\Html::tag('span', '上架中', ['class' => 'badge badge-success'])
                . '<br>' .
                Html::a('下架', \yii\helpers\Url::to(['/product/block']), [
                    'class' => 'btn btn-outline-danger btn-sm btn-product-block'
                ]);
        } else {
            return \yii\bootstrap4\Html::tag('span', '下架中', ['class' => 'badge badge-danger'])
                . '<br>' .
                Html::a('上架', \yii\helpers\Url::to(['/product/active']), [
                    'class' => 'btn btn-outline-success btn-sm btn-product-active'
                ]);
        }
    }

    public function asCashFlowType($type)
    {
        if ($type == \common\models\CashFlow::TYPE_DEPOSIT) {
            return \yii\bootstrap4\Html::tag('span', '支出', ['class' => 'badge badge-success']);
        } else {
            return \yii\bootstrap4\Html::tag('span', '入款', ['class' => 'badge badge-danger']);
        }
    }
}
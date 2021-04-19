<?php

namespace common\models;

use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property string $username
 * @property float $total_price
 * @property int $status
 * @property int|null $created_at
 * @property int|null $created_by
 *
 * @property OrderItem[] $orderItems
 * @property User $createdBy
 */
class Order extends ActiveRecord
{
    const STATUS_DRAFT = 0;
    const STATUS_PAID = 1;
    const STATUS_REFUND = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => false
            ],
            [
                'class' => BlameableBehavior::className(),
                'updatedByAttribute' => false
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'total_price', 'status'], 'required'],
            [['total_price'], 'number'],
            [['status', 'created_at', 'created_by'], 'integer'],
            [['username'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '訂單編號',
            'username' => '用戶名',
            'total_price' => '訂單總額',
            'status' => '狀態',
            'created_at' => '成立時間',
            'created_by' => 'Created By',
        ];
    }

    /**
     * Gets query for [[OrderItems]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\OrderItemQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['order_id' => 'id']);
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\OrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\OrderQuery(get_called_class());
    }

    public function saveOrderItems($userId)
    {
        $cartItems = CartItem::getItemsFromUser($userId);

        foreach ($cartItems as $cartItem) {
            $orderItem = new OrderItem();
            $orderItem->product_id = $cartItem['id'];
            $orderItem->product_name = $cartItem['name'];
            $orderItem->product_price = $cartItem['price'];
            $orderItem->order_id = $this->id;
            $orderItem->quantity = $cartItem['quantity'];

            if (!$orderItem->save()) {
                \Yii::error("新增商品錯誤： ".VarDumper::dumpAsString($orderItem->errors));
            }
        }
    }

    public static function getStatusLabels()
    {
        return [
            self::STATUS_PAID => '已付款',
            self::STATUS_REFUND => '已退款',
            self::STATUS_DRAFT => '未付款'
        ];
    }
}

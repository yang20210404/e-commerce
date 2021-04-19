<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "cash_flow".
 *
 * @property int $id
 * @property int $created_by
 * @property float $money
 * @property string|null $description
 * @property int $type
 * @property int|null $created_at
 *
 * @property User $user
 */
class CashFlow extends ActiveRecord
{
    const TYPE_DEPOSIT = 9;
    const TYPE_WITHDRAW = 10;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cash_flow';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => false
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_by', 'type'], 'required'],
            [['money'], 'required', 'message' => '金額不得為空'],
            [['created_by', 'type', 'created_at'], 'integer'],
            [['money'], 'integer', 'message' => '金額必須為整數'],
            [['description'], 'string'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_by' => 'created_by',
            'money' => '金額',
            'description' => '明細',
            'type' => '出/入款',
            'created_at' => '時間',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\CashFlowQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CashFlowQuery(get_called_class());
    }

    public function deposit()
    {
        $this->type = self::TYPE_WITHDRAW;
        $this->description = '<管理員後台充值>';

        $transaction = \Yii::$app->db->beginTransaction();

        if (parent::save($runValidation = true, $attributeNames = null)) {
            $user = User::findOne($this->created_by);
            $user->balance += $this->money;

            if ($user->save()) {
                $transaction->commit();

                return true;
            }
        }

        $transaction->rollBack();

        return false;
    }

    public function refund($order_id)
    {
        $order = Order::findOne(['id' => $order_id]);

        $this->money = (int)$order->total_price;
        $this->type = self::TYPE_WITHDRAW;
        $this->description = "<訂單退款> 訂單編號：$order->id";
        $this->created_by = $order->created_by;

        $transaction = \Yii::$app->db->beginTransaction();

        if (parent::save($runValidation = true, $attributeNames = null)) {
            $user = User::findOne($order->created_by);
            $user->balance += $order->total_price;

            if ($user->save()) {
                $order->status = Order::STATUS_REFUND;
                if ($order->save()) {
                    $transaction->commit();
                }
            }
        }

        $transaction->rollBack();
    }

    public function pay($order_id)
    {
        $order = Order::findOne(['id' => $order_id]);

        $this->money = (int)$order->total_price;
        $this->type = self::TYPE_DEPOSIT;
        $this->description = "<商城購物> 訂單編號：$order->id";
        $this->created_by = $order->created_by;

        $transaction = \Yii::$app->db->beginTransaction();
        $error = '';

        if (parent::save($runValidation = true, $attributeNames = null)) {
            $user = User::findOne($order->created_by);

            if ($user->balance >= $order->total_price) {
                $user->balance -= $order->total_price;

                if ($user->save()) {
                    $order->status = Order::STATUS_PAID;
                    if ($order->save()) {
                        $transaction->commit();
                    }
                }
            } else {
                $error = '餘額不足，請聯繫管理員充值';

            }
        }

        $transaction->rollBack();

        return $error;
    }
}

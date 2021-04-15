<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "cash_flow".
 *
 * @property int $id
 * @property int $user_id
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
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
            ],
            [
                'class' => BlameableBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_by'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_by', 'money', 'type'], 'required'],
            [['created_by', 'type', 'created_at'], 'integer'],
            [['money'], 'number'],
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
}

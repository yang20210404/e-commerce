<?php

namespace common\models;

use Yii;

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
class CashFlow extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cash_flow';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'money', 'type'], 'required'],
            [['user_id', 'type', 'created_at'], 'integer'],
            [['money'], 'number'],
            [['description'], 'string'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'money' => 'Money',
            'description' => 'Description',
            'type' => 'Type',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
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

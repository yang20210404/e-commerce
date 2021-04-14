<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\db\Query;


/**
 * This is the model class for table "cart_items".
 *
 * @property int $id
 * @property int $product_id
 * @property int $quantity
 * @property int|null $created_by
 *
 * @property User $createdBy
 * @property Product $product
 */
class CartItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cart_items';
    }

    public function behaviors()
    {
        return [
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
            [['product_id', 'quantity'], 'required'],
            [['product_id', 'quantity', 'created_by'], 'integer'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'quantity' => 'Quantity',
            'created_by' => 'Created By',
        ];
    }

    public static function getTotalQuantity($userId)
    {
        $query = new Query();
        $query->select('quantity')
            ->from('cart_items')
            ->where(['created_by' => $userId]);

        $sum = $query->sum('quantity');

        return $sum ? $sum : 0;
    }

    public static function getTotalPriceFormUser($userId)
    {
        return self::findBySql(
            "SELECT SUM(c.quantity * p.price)
                FROM cart_items c
                LEFT JOIN products p on p.id = c.product_id
            WHERE c.created_by = :userId", ['userId' => $userId]
        )->scalar();
    }

    public static function getTotalPriceFormItem($productId, $userId)
    {
        $cartItem = self::find()->andWhere([
            'product_id' => $productId,
            'created_by' => $userId
        ])->one();

        return $cartItem->quantity * $cartItem->product->price;
    }

    public static function getItemsFromUser($userId)
    {
        return self::findBySql(
            "SELECT
                       c.product_id as id,
                       p.image,
                       p.name,
                       p.price,
                       c.quantity,
                       p.price * c.quantity as total_price
                    FROM cart_items c
                    LEFT JOIN products p on p.id = c.product_id
                    WHERE c.created_by = :userId
                    ORDER BY c.id", ['userId' => $userId])
            ->asArray()
            ->all();
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
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\ProductQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\CartItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CartItemQuery(get_called_class());
    }
}

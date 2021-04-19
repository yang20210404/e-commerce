<?php

namespace common\models;

use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property string|null $description
 * @property string|null $image
 * @property float $price
 * @property int $status
 * @property int $is_delete
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property CartItem[] $cartItems
 * @property OrderItem[] $orderItems
 * @property User $createdBy
 * @property User $updatedBy
 */
class Product extends \yii\db\ActiveRecord
{
    const STATUS_DRAFT = 0;
    const STATUS_ACTIVE = 1;

    const NOT_DELETE = 0;
    const IS_DELETE = 1;

    /**
     * @var \yii\web\UploadedFile
     */
    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            BlameableBehavior::class
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'price', 'status', 'category_id'], 'required'],
            [['category_id'], 'match', 'pattern' => '/^(?!0).*$/', 'message' => '請選擇商品類別'],
            [['description'], 'string'],
            [['price'], 'number'],
            [['imageFile'], 'image', 'extensions' => 'png, jpg, jpeg'],
            [['status', 'created_at', 'updated_at', 'created_by', 'updated_by', 'is_delete'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['image'], 'string', 'max' => 2000],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '品名',
            'category_id' => '商品類別',
            'description' => '描述',
            'image' => '圖片',
            'imageFile' => '',
            'price' => '價格',
            'status' => '是否上架',
            'created_at' => '建立時間',
            'updated_at' => '修改時間',
            'createdBy.username' => '建立者',
            'updatedBy.username' => '修改者',
        ];
    }

    /**
     * Gets query for [[CartItems]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\CartItemQuery
     */
    public function getCartItems()
    {
        return $this->hasMany(CartItem::className(), ['product_id' => 'id']);
    }

    /**
     * Gets query for [[OrderItems]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\OrderItemQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['product_id' => 'id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\CategoryQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
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
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ProductQuery(get_called_class());
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        if ($this->imageFile) {
            $this->image = '/products/' . time() . '-' . $this->imageFile->name;
        }

        $transaction = \Yii::$app->db->beginTransaction();

        if (parent::save($runValidation, $attributeNames)) {
            OrderItem::updateAll(
                [
                    'product_name' => $this->name,
                    'product_price' => $this->price
                ],
                ['product_id' => $this->id]
            );

            if ($this->imageFile) {
                $fullPath = \Yii::getAlias('@frontend/web/storage' . $this->image);
                $dir = dirname($fullPath);

                if (!FileHelper::createDirectory($dir) || !$this->imageFile->saveAs($fullPath)) {
                    $transaction->rollBack();

                    return false;
                }
            }
        }

        $transaction->commit();

        return true;
    }

    public function getImageUrl()
    {
        return 'http://127.0.0.1/e-commerce/frontend/web/storage' . $this->image;
    }
}

<?php

namespace common\models;

use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "categories".
 *
 * @property int $id
 * @property string $name
 * @property int $is_delete
 *
 * @property Product[] $products
 */
class Category extends \yii\db\ActiveRecord
{
    const NOT_DELETE = 0;
    const IS_DELETE = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categories';
    }

    public static function getAllCategoryBySelect()
    {
        $categories = Category::find()->select(['id', 'name'])->andWhere(['is_delete' => Category::NOT_DELETE])->asArray()->all();

        $newCategories = [];
        foreach ($categories as $category) {
            $newCategories[] = [$category['id'] => $category['name']];
        }

        array_unshift($newCategories, '請選擇');

        return $newCategories;
    }

    public static function getAllCategory()
    {
        $categories = Category::find()->select(['id', 'name'])->andWhere(['is_delete' => Category::NOT_DELETE])->asArray()->all();

        return ArrayHelper::map($categories, 'id', 'name');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            ['name', 'unique', 'message' => '該類別名稱已被使用'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '商品類別',
        ];
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\ProductQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['category_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\CategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CategoryQuery(get_called_class());
    }
}

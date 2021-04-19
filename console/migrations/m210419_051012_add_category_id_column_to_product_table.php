<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%product}}`.
 */
class m210419_051012_add_category_id_column_to_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%products}}', 'category_id', $this->integer(11)->notNull()->after('id'));

        $this->createIndex(
            '{{%idx-products-category_id}}',
            '{{%products}}',
            'category_id'
        );

        $this->addForeignKey(
            '{{%fk-products-category_id}}',
            '{{%products}}',
            'category_id',
            '{{%categories}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            '{{%fk-products-category_id}}',
            '{{%products}}'
        );

        $this->dropIndex(
            '{{%idx-products-category_id}}',
            '{{%products}}'
        );

        $this->dropColumn('{{%products}}', 'category_id');
    }
}

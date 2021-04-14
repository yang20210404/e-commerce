<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cart_items}}`.
 */
class m210407_060358_create_cart_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cart_items}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(11)->notNull(),
            'quantity' => $this->integer(2)->notNull(),
            'created_by' => $this->integer(11)
        ]);

        $this->createIndex(
            '{{%idx-cart_items-product_id}}',
            '{{%cart_items}}',
            'product_id'
        );

        $this->addForeignKey(
            '{{%fk-cart_items-product_id}}',
            '{{%cart_items}}',
            'product_id',
            '{{%products}}',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            '{{%idx-cart_items-created_by}}',
            '{{%cart_items}}',
            'created_by'
        );

        $this->addForeignKey(
            '{{%fk-cart_items-created_by}}',
            '{{%cart_items}}',
            'created_by',
            '{{%user}}',
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
            '{{%fk-cart_items-product_id}}',
            '{{%cart_items}}'
        );

        $this->dropIndex(
            '{{%idx-cart_items-product_id}}',
            '{{%cart_items}}'
        );

        $this->dropForeignKey(
            '{{%fk-cart_items-created_by}}',
            '{{%cart_items}}'
        );

        // drops index for column `order_id`
        $this->dropIndex(
            '{{%idx-cart_items-created_by}}',
            '{{%cart_items}}'
        );

        $this->dropTable('{{%cart_items}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%products}}`.
 */
class m210407_060223_create_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%products}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'description' => 'LONGTEXT',
            'image' => $this->string(2000)->defaultValue('/products/noimage.jpeg'),
            'price' => $this->decimal(10, 2)->notNull(),
            'status' => $this->tinyInteger(2)->notNull(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'created_by' => $this->integer(11),
            'updated_by' => $this->integer(11),
        ]);

        $this->createIndex(
            '{{%idx-products-created_by}}',
            '{{%products}}',
            'created_by'
        );

        $this->addForeignKey(
            '{{%fk-products-created_by}}',
            '{{%products}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            '{{%idx-products-updated_by}}',
            '{{%products}}',
            'updated_by'
        );

        $this->addForeignKey(
            '{{%fk-products-updated_by}}',
            '{{%products}}',
            'updated_by',
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
            '{{%fk-products-created_by}}',
            '{{%products}}'
        );

        $this->dropIndex(
            '{{%idx-products-created_by}}',
            '{{%products}}'
        );

        $this->dropForeignKey(
            '{{%fk-products-updated_by}}',
            '{{%products}}'
        );

        $this->dropIndex(
            '{{%idx-products-updated_by}}',
            '{{%products}}'
        );

        $this->dropTable('{{%products}}');
    }
}

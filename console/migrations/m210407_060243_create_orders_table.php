<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%orders}}`.
 */
class m210407_060243_create_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%orders}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'total_price' => $this->decimal(10,2)->notNull(),
            'status' => $this->tinyInteger(1)->notNull(),
            'created_at' => $this->integer(11),
            'created_by' => $this->integer(11),
        ]);

        $this->createIndex(
            '{{%idx-orders-created_by}}',
            '{{%orders}}',
            'created_by'
        );

        $this->addForeignKey(
            '{{%fk-orders-created_by}}',
            '{{%orders}}',
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
            '{{%fk-orders-created_by}}',
            '{{%orders}}'
        );

        $this->dropIndex(
            '{{%idx-orders-created_by}}',
            '{{%orders}}'
        );

        $this->dropTable('{{%orders}}');
    }
}

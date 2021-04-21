<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cash_flow}}`.
 */
class m210407_060416_create_cash_flow_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cash_flow}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11)->notNull(),
            'money' => $this->decimal(10,2)->notNull(),
            'description' => 'LONGTEXT',
            'type' => $this->tinyInteger(1)->notNull(),
            'created_at' => $this->dateTime()
        ]);

        $this->createIndex(
            '{{%idx-cash_flow-user_id}}',
            '{{%cash_flow}}',
            'user_id'
        );

        $this->addForeignKey(
            '{{%fk-cash_flow-user_id}}',
            '{{%cash_flow}}',
            'user_id',
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
            '{{%fk-cash_flow-user_id}}',
            '{{%cash_flow}}'
        );

        $this->dropIndex(
            '{{%idx-cash_flow-user_id}}',
            '{{%cash_flow}}'
        );

        $this->dropTable('{{%cash_flow}}');
    }
}

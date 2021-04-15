<?php

use yii\db\Migration;

/**
 * Class m210415_040426_rename_columns_to_cash_flow_table
 */
class m210415_040426_rename_columns_to_cash_flow_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('{{%cash_flow}}', 'user_id', 'created_by');

        $this->dropForeignKey(
            '{{%fk-cash_flow-user_id}}',
            '{{%cash_flow}}'
        );

        $this->dropIndex(
            '{{%idx-cash_flow-user_id}}',
            '{{%cash_flow}}'
        );

        $this->createIndex(
            '{{%idx-cash_flow-created_by}}',
            '{{%cash_flow}}',
            'created_by'
        );

        $this->addForeignKey(
            '{{%fk-cash_flow-created_by}}',
            '{{%cash_flow}}',
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
        $this->renameColumn('{{%cash_flow}}', 'created_by', 'user_id');

        $this->dropForeignKey(
            '{{%fk-cash_flow-created_by}}',
            '{{%cash_flow}}'
        );

        $this->dropIndex(
            '{{%idx-cash_flow-created_by}}',
            '{{%cash_flow}}'
        );

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
}

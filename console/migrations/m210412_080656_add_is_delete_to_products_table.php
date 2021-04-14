<?php

use yii\db\Migration;

/**
 * Class m210412_080656_add_is_delete_to_products_table
 */
class m210412_080656_add_is_delete_to_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%products}}', 'is_delete', $this->boolean()->defaultValue(0)->after('status'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%products}}', 'is_delete');
    }
}

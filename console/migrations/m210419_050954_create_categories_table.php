<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category}}`.
 */
class m210419_050954_create_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%categories}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull()->unique(),
            'is_delete' => $this->boolean()->defaultValue(0)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%categories}}');
    }
}

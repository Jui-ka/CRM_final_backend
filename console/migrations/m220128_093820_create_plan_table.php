<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%plan}}`.
 */
class m220128_093820_create_plan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%plan}}', [
            'plan_id' => $this->primaryKey(),
            'plan_name' => $this->string()->notNull(),
            'plan_validity' => $this->string()->notNull(),
            'plan_data' => $this->string()->notNull(),
            'plan_price' => $this->string()->notNull(),
            
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%plan}}');
    }
}

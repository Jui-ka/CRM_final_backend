<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%address}}`.
 */
class m220128_093636_create_address_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%address}}', [
            'address_id' => $this->primaryKey(),
            'state' => $this->string()->notNull(),
            'add_line_1' => $this->string()->notNull(),
            'add_line_2' => $this->string()->notNull(),
            'city' => $this->string()->notNull(),
            'zipcode' => $this->integer()->notNull(),
            'country' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%address}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%person}}`.
 */
class m220128_093217_create_person_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%person}}', [
            'person_id' => $this->primaryKey(),
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'gender' => $this->string()->notNull(),
            'date_of_birth' => $this->date()->notNull(),
            'email' => $this->string()->notNull(),
            'contact_no' => $this->integer()->notNull(),
            'address_id' => $this->string()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-person-address_id',
            'person',
            'address_id',
            'address',
            'address_id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%person}}');

        $this->dropForeignKey(
            'fk-person-address_id',
            'person'
        );
    }
}

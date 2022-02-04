<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%employee}}`.
 */
class m220128_092311_create_employee_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%employee}}', [
            'emp_id' => $this->primaryKey(),
            'designation' => $this->string()->notNull(),
            'person_id' => $this->integer()->notNull(),
            
        ]);

        $this->addForeignKey(
            'fk-employee-person_id',
            'employee',
            'person_id',
            'person',
            'person_id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%employee}}');

        $this->dropForeignKey(
            'fk-employee-person_id',
            'employee'
        );
    }
}

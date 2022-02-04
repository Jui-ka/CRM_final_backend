<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%task}}`.
 */
class m220128_095626_create_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%task}}', [
            'task_id' => $this->primaryKey(),
        
            'task_name' => $this->string()->notNull(),
            'task_desc' => $this->string()->notNull(),
            'task_status' => $this->string()->notNull(),
            'created_at' => $this->date()->notNull(),
            'person_id' => $this->integer()->notNull(),
            'emp_id' => $this->integer()->notNull(),
            'module_name' => $this->string()->notNull(),

            
        ]);

        $this->addForeignKey(
            'fk-task-emp_id',
            'task',
            'emp_id',
            'employee',
            'emp_id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-task-person_id',
            'task',
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
        $this->dropTable('{{%task}}');

        
        $this->dropForeignKey(
            'fk-task-person_id',
            'task'
        );

        $this->dropForeignKey(
            'fk-task-emp_id',
            'task'
        );
    }
}

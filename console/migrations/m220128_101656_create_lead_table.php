<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%lead}}`.
 */
class m220128_101656_create_lead_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%lead}}', [
            'lead_id' => $this->primaryKey(),
            'created_at' => $this->date()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_at' => $this->date()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'person_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-lead-created_by',
            'lead',
            'created_by',
            'employee',
            'emp_id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-lead-updated_by',
            'lead',
            'updated_by',
            'employee',
            'emp_id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-lead-person_id',
            'lead',
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
        $this->dropTable('{{%lead}}');

        $this->dropForeignKey(
            'fk-lead-created_by',
            'lead'
        );


        $this->dropForeignKey(
            'fk-lead-updated_by',
            'lead'
        );

        $this->dropForeignKey(
            'fk-lead-person_id',
            'lead'
        );
    }
}

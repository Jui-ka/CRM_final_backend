<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%opportunity}}`.
 */
class m220128_093949_create_opportunity_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%opportunity}}', [
            'opportunity_id' => $this->primaryKey(),
            'created_at' => $this->date()->notNull(),
            'status' => $this->string()->notNull(),
            'lead_id' => $this->integer()->notNull(),
            'person_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-opportunity-lead_id',
            'opportunity',
            'lead_id',
            'lead',
            'lead_id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-opportunity-person_id',
            'opportunity',
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
        $this->dropTable('{{%opportunity}}');

        $this->dropForeignKey(
            'fk-opportunity-lead_id',
            'opportunity'
        );

        $this->dropForeignKey(
            'fk-opportunity-person_id',
            'opportunity'
        );
    }
}

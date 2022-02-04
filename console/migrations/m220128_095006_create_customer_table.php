<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%customer}}`.
 */
class m220128_095006_create_customer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%customer}}', [
            'customer_id' => $this->primaryKey(),
          
            'opportunity_id' => $this->integer()->notNull(),
            'plan_id' => $this->integer()->notNull(),
            'emp_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-customer-opportunity_id',
            'customer',
            'opportunity_id',
            'opportunity',
            'opportunity_id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-customer-plan_id',
            'customer',
            'plan_id',
            'plan',
            'plan_id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-customer-emp_id',
            'customer',
            'emp_id',
            'employee',
            'emp_id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%customer}}');

        
        $this->dropForeignKey(
            'fk-customer-opportunity_id',
            'customer'
        );

        $this->dropForeignKey(
            'fk-customer-plan_id',
            'customer'
        );

        $this->dropForeignKey(
            'fk-customer-emp_id',
            'customer'
        );
    }
}

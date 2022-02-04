<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property int $customer_id
 * @property int $opportunity_id
 * @property int $plan_id
 * @property int $emp_id
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public $plan_name;
    public $emp_name;
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['opportunity_id', 'plan_id', 'emp_id'], 'required'],
            [['opportunity_id', 'plan_id', 'emp_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'customer_id' => 'Customer ID',
            'opportunity_id' => 'Opportunity ID',
            'plan_id' => 'Plan ID',
            'emp_id' => 'Emp ID',
        ];
    }

    public function getPlan() {
        return $this->hasOne(Plan::className(), ['plan_id' => 'plan_id']);
    }

    public function getEmployee() {
        return $this->hasOne(Employee::className(), ['emp_id' => 'emp_id']);
    }

    public function getOpportunity() {
        return $this->hasOne(Opportunity::className(), ['opportunity_id' => 'opportunity_id']);
    }

   
}

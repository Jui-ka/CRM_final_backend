<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "opportunity".
 *
 * @property int $opportunity_id
 * @property int $lead_id
 * @property int $person_id
 * @property int $plan_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Customer[] $customers
 * @property Lead $lead
 * @property Person $person
 * @property Plan $plan
 */
class Opportunity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'opportunity';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['person_id', 'plan_id'], 'required'],
            [['lead_id', 'person_id', 'plan_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            // [['lead_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lead::className(), 'targetAttribute' => ['lead_id' => 'lead_id']],
            [['person_id'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(), 'targetAttribute' => ['person_id' => 'person_id']],
            [['plan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Plan::className(), 'targetAttribute' => ['plan_id' => 'plan_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'opportunity_id' => 'Opportunity ID',
            'lead_id' => 'Lead ID',
            'person_id' => 'Person ID',
            'plan_id' => 'Plan ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Customers]].
     *
     * @return \yii\db\ActiveQuery|\common\models\Query\CustomerQuery
     */
    public function getCustomers()
    {
        return $this->hasMany(Customer::className(), ['opportunity_id' => 'opportunity_id']);
    }

    /**
     * Gets query for [[Lead]].
     *
     * @return \yii\db\ActiveQuery|\common\models\Query\LeadQuery
     */
    public function getLead()
    {
        return $this->hasOne(Lead::className(), ['lead_id' => 'lead_id']);
    }

    /**
     * Gets query for [[Person]].
     *
     * @return \yii\db\ActiveQuery|\common\models\Query\PersonQuery
     */
    public function getPerson()
    {
        return $this->hasOne(Person::className(), ['person_id' => 'person_id']);
    }

    /**
     * Gets query for [[Plan]].
     *
     * @return \yii\db\ActiveQuery|\common\models\Query\PlanQuery
     */
    public function getPlan()
    {
        return $this->hasOne(Plan::className(), ['plan_id' => 'plan_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Query\OpportunityQuery the active query used by this AR class.
     */
    // public static function find()
    // {
    //     return new \common\models\Query\OpportunityQuery(get_called_class());
    // }
}

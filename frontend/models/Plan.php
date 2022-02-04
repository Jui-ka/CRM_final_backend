<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "plan".
 *
 * @property int $plan_id
 * @property string $plan_name
 * @property string $
 * @property string $plan_validity
 * @property int $plan_price
 * @property string $created_at
 * @property string $updated_at
 * @property int|null $is_deleted
 *
 * @property Opportunity[] $opportunities
 */
class Plan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['plan_name', 'plan_validity', 'plan_price', 'plan_data'], 'required'],
            [['plan_price'], 'integer'],
            [['plan_name', 'plan_validity'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
    //  */
    // public function attributeLabels()
    // {
    //     return [
    //         'plan_id' => 'Plan ID',
    //         'plan_name' => 'Plan Name',
    //         'plan_validity' => 'Plan Validity',
    //         'plan_price' => 'Plan Price',

    //     ];
    // }

    /**
     * Gets query for [[Opportunities]].
     *
     * @return \yii\db\ActiveQuery|\common\models\Query\OpportunityQuery
     */
   
}

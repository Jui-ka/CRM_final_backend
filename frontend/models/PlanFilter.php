<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Plan;

class PlanFilter extends Plan
{
    /**
     * {@inheritdoc}
     */
    public $plan_id;
    public $plan_name;
    public $plan_validity;
    public $plan_price;
    // public $plan_description;
    
    public function rules()
    {
        return [
            [['plan_id','plan_price'], 'integer'],
            [['plan_name','plan_validity','plan_price'], 'safe'],
        ];
    }
  
}
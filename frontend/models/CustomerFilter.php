<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Customer;
use frontend\models\Plan;
use frontend\models\Leads;
use frontend\models\CustomerSearch;


class CustomerFilter extends Customer
{
    

    public $plan_name;
    public $first_name;
    //public $cust_name;
   
    public function rules()
    {
        return [
            [['customer_id','emp_id', 'plan_id', 'person_id', 'first_name', 'plan_name'], 'required'],
            [['emp_id', 'plan_id'], 'integer'],
            [['customer_id', 'first_name', 'plan_name'], 'safe'],
            
        ];
    }

   
}

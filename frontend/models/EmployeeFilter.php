<?php

namespace frontend\models;
use frontend\models\Employee;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use Yii;

class EmployeeFilter extends Employee
{
        public $city;
        public $first_name;
        public $designation;
    

    public function rules()
    {
        return [
            [['designation','person_id','first_name','last_name','city'], 'required'],
            [['designation','emp_id','first_name','city'], 'safe'],
            [['emp_id'],'integer'],
        ];
    }
}
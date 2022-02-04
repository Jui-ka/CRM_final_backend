<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Task;
use frontend\models\Plan;
use frontend\models\Leads;
use frontend\models\TaskSearch;


class TaskFilter extends Task
{

    public $first_name;
    //public $cust_name;
   
    public function rules()
    {
        return [
            [['task_name', 'task_desc', 'task_status', 'created_at', 'person_id', 'emp_id', 'module_name', 'first_name'], 'required'],
            [['task_id', 'task_name', 'task_desc', 'task_status', 'created_at', 'first_name'], 'safe'],
            [['person_id', 'emp_id'], 'integer'],
            [['task_name', 'task_desc', 'task_status', 'module_name'], 'string', 'max' => 255]
        ];
    }

   
}

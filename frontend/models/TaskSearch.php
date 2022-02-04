<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Task;
use frontend\models\Plan;
use frontend\models\Employee;
use frontend\models\TaskFilter;
use yii\data\ActiveDataFilter;
/**
 * LeadSearch represents the model behind the search form of `frontend\models\Leads`.
 */
class TaskSearch extends Task
{
    /**
     * {@inheritdoc}
     */
    public $plan_name;
    
    public function fields() {
        return [
            'task_id', 
            'task_name', 
            'task_desc', 
            'task_status', 
            'created_at',
           
        'person' => function ($model) {
            return $model->employee->person;
        },
        
    ];
    }
  
    public function rules()
    {
        return [
            [['task_name', 'task_desc', 'task_status', 'created_at', 'person_id', 'emp_id', 'module_name'], 'required'],
            [['task_name', 'task_desc', 'task_status', 'created_at'], 'safe'],
            [['person_id', 'emp_id'], 'integer'],
            [['task_name', 'task_desc', 'task_status', 'module_name'], 'string', 'max' => 255]
        ];
    }

    

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {

        // echo ('working');
        // die;
       $filter = new ActiveDataFilter([
         'searchModel' => 'frontend\models\TaskFilter'
      ]);
      
         $filterCondition = null;
      

    if ($filter->load(\Yii::$app->request->get())) { 
        $filterCondition = $filter->build();
       if ($filterCondition === false) {

     return $filter;
      }
       }
       
      $query = self::find();
        // add join query
        $query->joinWith(['employee', 'employee.person']);
        $query->andFilterWhere([
            'emp.emp_id' => $this->emp_id,
            
        ]);
      
     
       if ($filterCondition !== null) {
    $query->andWhere($filterCondition);
    }
    //  echo $query->createCommand()->rawSql;
    //    die;
    
  return new ActiveDataProvider([
  'query' => $query,
]);
        $this->load($params);
        $query = Customer::find();
      

        // $dataProvider = new ActiveDataProvider([
        //     'query' => $query,
        // ]);

        $dataProvider->setSort([
            'attributes' => [
                'task_id',
                'task_name',
                'task_status',
                'task_desc',
                'first_name' => [
                    'asc' => ['employee.person.first_name' => SORT_ASC],
                    'desc' => ['employee.person.first_name' => SORT_DESC],
                    'label' => 'first_name',
                    'default' => SORT_ASC
                ]
            ],
              
        ]);


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'customer_id' => $this->customer_id,
           
        ]);

        

        return $dataProvider;
    }

  
    
}

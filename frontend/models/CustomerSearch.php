<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Customer;
use frontend\models\Plan;
use frontend\models\Employee;
use frontend\models\CustomerFilter;
use yii\data\ActiveDataFilter;
/**
 * LeadSearch represents the model behind the search form of `frontend\models\Leads`.
 */
class CustomerSearch extends Customer
{
    /**
     * {@inheritdoc}
     */
    public $plan_name;
    
    public function fields() {
        return [
            'customer_id', 
            //'customer_name',
        //'emp_id',
        'person' => function ($model) {
            return $model->employee->person;
        },
        'employee' => function ($model) {
            return $model->employee;
        },
        'plan' => function ($model) {
            return $model->plan;
        },

        'opportunity' => function ($model) {
            return $model->opportunity;
        },
    ];
    }
  
    public function rules()
    {
        return [
            [['cust_id', 'emp_id', 'plan_id'], 'required'],
            [['emp_id', 'plan_id'], 'integer'],
            [['plan_name', 'first_name'], 'string', 'max' => 30],
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
         'searchModel' => 'frontend\models\CustomerFilter'
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
        $query->joinWith(['plan', 'employee', 'employee.person']);
        $query->andFilterWhere([
            'plan.plan_name' => $this->plan_name,
            
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
                'customer_id',
                'plan_id',
                'emp_id',
                'opportunity_id',
                'plan_name' => [
                    'asc' => ['plan_name' => SORT_ASC],
                    'desc' => ['plan_name' => SORT_DESC],
                    'label' => 'Plan Name',
                    'default' => SORT_ASC
                ],
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

        $query->andFilterWhere(['like', 'plan_name', $this->plan_name]);
        

        return $dataProvider;
    }

  
    
}

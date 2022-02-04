<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Employee;
use frontend\models\Person;
use frontend\models\Address;
use frontend\models\PersonFilter;
use yii\data\ActiveDataFilter;
/**
 * EmployeeSearch represents the model behind the search form of `frontend\models\Employee`.
 */
class EmployeeSearch extends Employee
{
    public function fields() {
        return ['emp_id','designation',
          //'emp_id',
          'person' => function ($model) {
            return $model->person;
        },
         'address' => function ($model) {
            return $model->person->address;
        },
    ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['emp_id', 'person_id'], 'integer'],
            [['designation'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Employee::scenarios();
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

        $filter = new ActiveDataFilter([
            'searchModel' => 'frontend\models\EmployeeFilter'
               ]);
            
            $filterCondition = null;
            
            if ($filter->load(\Yii::$app->request->get())) { 
             $filterCondition = $filter->build();
              if ($filterCondition === false) {
            
            return $filter;
             }
             }

           
   
        $query = self::find();
        $query->joinWith(['person','person.address']);
        $query->where(['employee.is_deleted'=> 0]);
        $query->andFilterWhere([
            'person.person_id'=>$this->person_id,
        ]);

        if ($filterCondition !== null) {
            $query->andWhere($filterCondition);
            }

      
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        

     

        $this->load($params);
        $query = Employee::find();

        $dataProvider->setSort([
            'attributes' => [
                'emp_id',
                'last_name',
                'first_name' => [
                    'asc' => ['first_name' => SORT_ASC],
                    'desc' => ['first_name' => SORT_DESC],
                    'label' => 'First Name',
                    'default' => SORT_ASC
                ],
                'city' => [
                    'asc' => ['address.city' => SORT_ASC],
                    'desc' => ['address.city' => SORT_DESC],
                    'label' => 'City',
                    'default' => SORT_ASC
                ]],
        ]);


        $this->load($params);
        
        if (!$this->validate()) {
            return $dataProvider;
        }
        return $dataProvider;
    }
    public function getPerson(){
        return $this->hasOne(Person::className(), ['person_id' => 'person_id']);
     }
}
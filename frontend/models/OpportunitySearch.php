<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Opportunity;
use common\models\Person;
use common\models\Plan;
use yii\data\ActiveDataFilter;

class OpportunitySearch extends Opportunity
{
    /**
     * {@inheritdoc}
     */
 
     public function fields() {
        return [
            'lead_id',
            'person' => function ($model) {
                return $model->person;
            },
            'address' => function ($model) {
                return $model->person->address;
            },
            'plan' => function ($model) {
                return $model->plan;
            },
        ];
    }

    public function rules()
    {
        return [
            [['opportunity_id','lead_id','person_id','plan_id'], 'integer'],
            [['opportunity_id','lead_id','person_id','plan_id'], 'safe'],
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
        $filter = new ActiveDataFilter([
            'searchModel' => 'common\models\OpportunityFilter',
            'attributeMap' => [
                'person_id' => 'person.person_id',
            ],
            'attributeMap' => [
                'plan_id' => 'plan.plan_id',
            ],
        ]);
        
        $filterCondition = null;
        
        // You may load filters from any source. For example,
        // if you prefer JSON in request body,
        // use Yii::$app->request->getBodyParams() below:
        if ($filter->load(\Yii::$app->request->get())) { 
            $filterCondition = $filter->build();
            if ($filterCondition === false) {
                // Serializer would get errors out of it
                return $filter;
            }
        }
        
        $query = self::find();
        $query->joinWith(['person', 'plan', 'person.address']);
    
        if ($filterCondition !== null) {
            $query->andWhere($filterCondition);
        }       
        
        // if ($filterCondition !== null) {
        //     $query->andWhere($filterCondition);
        // }
 
 
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'opportunity_id',
                'person_id',
                'plan_id',
                'lead_id',
                'firstname' => [
                    'asc' => ['firstname' => SORT_ASC],
                    'desc' => ['firstname' => SORT_DESC],
                    'label' => 'Person Name',
                    'default' => SORT_ASC
                ],
                'email_id' => [
                    'asc' => ['email_id' => SORT_ASC],
                    'desc' => ['email_id' => SORT_DESC],
                    'label' => 'Person Name',
                    'default' => SORT_ASC
                ],
                'city' => [
                    'asc' => ['address.city' => SORT_ASC],
                    'desc' => ['address.city' => SORT_DESC],
                    'label' => 'Person Name',
                    'default' => SORT_ASC
                ],
                'contact_no' => [
                    'asc' => ['contact_no' => SORT_ASC],
                    'desc' => ['contact_no' => SORT_DESC],
                    'label' => 'Person Name',
                    'default' => SORT_ASC
                ],
                'plan_name' => [
                    'asc' => ['plan_name' => SORT_ASC],
                    'desc' => ['plan_name' => SORT_DESC],
                    'label' => 'Plan Name',
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
            'opportunity_id' => $this->opportunity_id,
            'person_id' => $this->person_id,
            'plan_id' => $this->plan_id,
            'lead_id' => $this->lead_id,
        ]);

        // $query->andFilterWhere(['like', 'person_id', $this->person_id]);

        return $dataProvider;
    }

    public function getPerson() {
        return $this->hasOne(Person::className(), ['person_id' => 'person_id']);
    }

    public function getPlan() {
        return $this->hasOne(Plan::className(), ['plan_id' => 'plan_id']);
    }

}
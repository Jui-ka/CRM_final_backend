<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Plan;
use yii\data\ActiveDataFilter;

class PlanSearch extends Plan
{
    /**
     * {@inheritdoc}
     */
 
    public function rules()
    {
        return [
            [['plan_id','plan_price'], 'integer'],
            [['plan_name', 'plan_validity', 'plan_price'], 'safe'],
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
            'searchModel' => 'frontend\models\PlanFilter'
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
        
        $query = Plan::find();
       
    
        if ($filterCondition !== null) {
            $query->andWhere($filterCondition);
        }
    //   echo  $query->createCommand()->rawSql;
        // die;
     
        
/*
     if ($filterCondition !== null) {
        $query->andWhere($filterCondition);
    }*/
 
 
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'plan_id',
                'plan_name',
                'plan_validity',
                'plan_price',
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
            'plan_id' => $this->plan_id,
            'plan_name' => $this->plan_name,
            'plan_validity' => $this->plan_validity,
            'plan_price' => $this->plan_price,
            // 'plan_description' => $this->plan_description,

        ]);

        $query->andFilterWhere(['like', 'plan_name', $this->plan_name]);

        return $dataProvider;
    }

}
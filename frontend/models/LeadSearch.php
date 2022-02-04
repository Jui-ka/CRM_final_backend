<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Lead;
use app\models\Person;
use app\models\Address;
use yii\data\ActiveDataFilter;

/**
 * LeadSearch represents the model behind the search form of `app\models\Lead`.
 */
class LeadSearch extends Lead
{

  public function fields() {

    // return ['lead_id'];
        return ['lead_id','updated_at',
        'created_at',
          //'emp_id',
          'person' => function ($model) {
            return $model->person;
        },
         'address' => function ($model) {
            return $model->person->address;
        },
    ];
    }

  // public $personName;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lead_id','person_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Lead::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    //
    public function search($params){

      $filter = new ActiveDataFilter([
           'searchModel' => 'frontend\models\LeadFilter'
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
        $query->where(['lead.is_deleted'=> 0]);
        $query->andFilterWhere([
            'person.person_id'=>$this->person_id,
        ]);

        if ($filterCondition !== null) {
            $query->andWhere($filterCondition);
            }

            $query->addOrderBy(['updated_at'=> SORT_DESC]);


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        $query = Lead::find();

        $dataProvider->setSort([
            'attributes' => [
                'lead_id',
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
          // return $dataProvider;


        if ($this->validate()) {
          return $dataProvider;
    }
        }

        public function getPerson(){
            return $this->hasOne(Person::className(), ['person_id' => 'person_id']);
         }

}

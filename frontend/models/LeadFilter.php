<?php

namespace frontend\models;
use app\models\Lead;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use Yii;

class LeadFilter extends Lead
{
        public $city;
        public $first_name;
        public $updated_at;


    public function rules()
    {
        return [
            [['updated_at','person_id','first_name','last_name','city'], 'required'],
            [['updated_at','lead_id','first_name','city'], 'safe'],
            [['lead_id'],'integer'],
        ];
    }
}

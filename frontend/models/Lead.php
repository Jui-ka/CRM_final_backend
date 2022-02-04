<?php

namespace app\models;

use Yii;
use app\models\Person;
use app\models\PersonSearch;

/**
 * This is the model class for table "lead".
 *
 * @property int $lead_id
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $person_id
 */
class Lead extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lead';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['updated_at', 'person_id'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'lead_id' => 'Lead ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'person_id' => 'Person ID'
        ];
    }

    public function getPerson(){
      return $this->hasOne(Person::className(),['person_id'=>'person_id']);
    }
}

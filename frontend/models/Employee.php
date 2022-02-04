<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property int $emp_id
 * @property string $designation
 * @property int $person_id
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['designation', 'person_id'], 'required'],
            [['person_id'], 'integer'],
            [['designation', 'first_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'emp_id' => 'Emp ID',
            'designation' => 'Designation',
            'person_id' => 'Person ID',
            'created_at' => 'Created at'
        ];
    }

    public function getPerson() {
        return $this->hasOne(Person::className(), ['person_id' => 'person_id']);
    }
}

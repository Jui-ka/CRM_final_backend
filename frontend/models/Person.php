<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "person".
 *
 * @property int $person_id
 * @property string $first_name
 * @property string $last_name
 * @property string $gender
 * @property string $date_of_birth
 * @property string $email
 * @property int $contact_no
 * @property int $address_id
 *
 * @property Address $address
 * @property Employee[] $employees
 * @property Lead[] $leads
 * @property Opportunity[] $opportunities
 * @property Task[] $tasks
 */
class Person extends \yii\db\ActiveRecord
{
    // public $person_id=2;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'person';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'gender', 'date_of_birth', 'email', 'contact_no', 'address_id'], 'required'],
            [['date_of_birth','first_name'], 'safe'],
            [['contact_no', 'address_id'], 'integer'],
            [['email'],'email'],
            [['email'],'unique'],
            [['first_name', 'last_name', 'gender', 'email'], 'string', 'max' => 255]
            // [['address_id'], 'exist', 'skipOnError' => true, 'targetClass' => Address::className(), 'targetAttribute' => ['address_id' => 'address_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'person_id' => 'Person ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'gender' => 'Gender',
            'date_of_birth' => 'Date Of Birth',
            'email' => 'Email',
            'contact_no' => 'Contact No',
            'address_id' => 'Address ID',
        ];
    }

    /**
     * Gets query for [[Address]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAddress()
    {
        return $this->hasOne(Address::className(), ['address_id' => 'address_id']);
    }

    /**
     * Gets query for [[Employees]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployees()
    {
        return $this->hasMany(Employee::className(), ['person_id' => 'person_id']);
    }

    /**
     * Gets query for [[Leads]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLeads()
    {
        return $this->hasMany(Lead::className(), ['person_id' => 'person_id']);
    }

    /**
     * Gets query for [[Opportunities]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOpportunities()
    {
        return $this->hasMany(Opportunity::className(), ['person_id' => 'person_id']);
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['person_id' => 'person_id']);
    }
}

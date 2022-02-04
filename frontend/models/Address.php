<?php

namespace frontend\models;
use Yii;
/**
 * This is the model class for table "address".
 *
 * @property int $address_id
 * @property string $state
 * @property string $add_line_1
 * @property string $add_line_2
 * @property string $city
 * @property int $zipcode
 * @property string $country
 *
 * @property Person[] $people
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'address';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['state', 'add_line_1', 'add_line_2', 'city', 'zipcode', 'country'], 'required'],
          
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'state' => 'State',
            'add_line_1' => 'Add Line 1',
            'add_line_2' => 'Add Line 2',
            'city' => 'City',
            'zipcode' => 'Zipcode',
            'country' => 'Country',
        ];
    }


//     public function getPeople()
//     {
//         return $this->hasMany(Person::className(), ['address_id' => 'address_id']);
//     }
// }
}
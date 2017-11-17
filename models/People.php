<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ospos_people".
 *
 * @property string $first_name
 * @property string $last_name
 * @property string $phone_number
 * @property string $email
 * @property string $address_1
 * @property string $address_2
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property string $country
 * @property string $comments
 * @property integer $person_id
 *
 * @property OsposCustomers[] $osposCustomers
 * @property OsposEmployees[] $osposEmployees
 * @property OsposSuppliers[] $osposSuppliers
 */
class People extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ospos_people';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'phone_number', 'email', 'address_1'], 'required'],
            [['address_2', 'city', 'state', 'zip', 'country', 'comments'], 'safe'],
            [['comments'], 'string'],
            [['first_name', 'last_name', 'phone_number', 'email', 'address_1', 'address_2', 'city', 'state', 'zip', 'country'], 'string', 'max' => 255],
            [['person_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'phone_number' => 'Phone Number',
            'email' => 'Email',
            'address_1' => 'Address 1',
            'address_2' => 'Address 2',
            'city' => 'City',
            'state' => 'State',
            'zip' => 'Zip',
            'country' => 'Country',
            'comments' => 'Comments',
            'person_id' => 'Person ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOsposCustomers()
    {
        return $this->hasMany(OsposCustomers::className(), ['person_id' => 'person_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOsposEmployees()
    {
        return $this->hasMany(OsposEmployees::className(), ['person_id' => 'person_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOsposSuppliers()
    {
        return $this->hasMany(OsposSuppliers::className(), ['person_id' => 'person_id']);
    }
}

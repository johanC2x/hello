<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ospos_customers".
 *
 * @property integer $person_id
 * @property string $account_number
 * @property integer $taxable
 * @property integer $deleted
 *
 * @property OsposPeople $person
 * @property OsposSales[] $osposSales
 * @property OsposSalesSuspended[] $osposSalesSuspendeds
 */
class Customers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ospos_customers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['person_id'], 'required'],
            [['person_id', 'taxable', 'deleted'], 'integer'],
            [['account_number'], 'string', 'max' => 255],
            [['account_number'], 'unique'],
            [['person_id'], 'exist', 'skipOnError' => true, 'targetClass' => OsposPeople::className(), 'targetAttribute' => ['person_id' => 'person_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'person_id' => 'Person ID',
            'account_number' => 'Account Number',
            'taxable' => 'Taxable',
            'deleted' => 'Deleted',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(OsposPeople::className(), ['person_id' => 'person_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOsposSales()
    {
        return $this->hasMany(OsposSales::className(), ['customer_id' => 'person_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOsposSalesSuspendeds()
    {
        return $this->hasMany(OsposSalesSuspended::className(), ['customer_id' => 'person_id']);
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ospos_receivings".
 *
 * @property string $receiving_time
 * @property integer $supplier_id
 * @property integer $employee_id
 * @property string $comment
 * @property integer $receiving_id
 * @property string $payment_type
 *
 * @property OsposEmployees $employee
 * @property OsposSuppliers $supplier
 * @property OsposReceivingsItems[] $osposReceivingsItems
 */
class Receivings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ospos_receivings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['receiving_time'], 'safe'],
            [['supplier_id', 'employee_id'], 'integer'],
            [['comment'], 'required'],
            [['comment'], 'string'],
            [['payment_type'], 'string', 'max' => 20],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => OsposEmployees::className(), 'targetAttribute' => ['employee_id' => 'person_id']],
            [['supplier_id'], 'exist', 'skipOnError' => true, 'targetClass' => OsposSuppliers::className(), 'targetAttribute' => ['supplier_id' => 'person_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'receiving_time' => 'Receiving Time',
            'supplier_id' => 'Supplier ID',
            'employee_id' => 'Employee ID',
            'comment' => 'Comment',
            'receiving_id' => 'Receiving ID',
            'payment_type' => 'Payment Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(OsposEmployees::className(), ['person_id' => 'employee_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupplier()
    {
        return $this->hasOne(OsposSuppliers::className(), ['person_id' => 'supplier_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOsposReceivingsItems()
    {
        return $this->hasMany(OsposReceivingsItems::className(), ['receiving_id' => 'receiving_id']);
    }
}

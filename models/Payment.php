<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ospos_payment".
 *
 * @property integer $id
 * @property integer $employee_id
 * @property integer $year
 * @property integer $month
 * @property double $payment_sol
 * @property double $payment_dol
 * @property double $payment_dscto
 * @property integer $cuentad
 * @property integer $cuentah
 * @property string $created_at
 * @property string $updated_at
 *
 * @property OsposEmployees $employee
 */
class Payment extends \yii\db\ActiveRecord{
    /**
     * @inheritdoc
     */
    public static function tableName(){
        return 'ospos_payment';
    }

    /**
     * @inheritdoc
     */
    public function rules(){
        return [
            [['employee_id', 'year', 'month', 'payment_sol', 'payment_dol', 'payment_dscto'], 'required'],
            [['employee_id', 'year', 'month', 'cuentad', 'cuentah'], 'integer'],
            [['payment_sol', 'payment_dol', 'payment_dscto'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employees::className(), 'targetAttribute' => ['employee_id' => 'person_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(){
        return [
            'id' => 'ID',
            'employee_id' => 'Employee ID',
            'year' => 'Year',
            'month' => 'Month',
            'payment_sol' => 'Payment Sol',
            'payment_dol' => 'Payment Dol',
            'payment_dscto' => 'Payment Dscto',
            'cuentad' => 'Cuentad',
            'cuentah' => 'Cuentah',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee(){
        return $this->hasOne(Employees::className(), ['person_id' => 'employee_id']);
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ospos_entity".
 *
 * @property string $ruc
 * @property string $name
 * @property string $name_short
 * @property integer $flg_bank
 * @property integer $flg_salud
 * @property integer $flg_educ
 * @property integer $number_length
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class Entity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ospos_entity';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ruc', 'name'], 'required'],
            [['flg_bank', 'flg_salud', 'flg_educ','status'], 'integer'],
            [['status','name_short','created_at', 'updated_at', 'number_length', 'flg_bank', 'flg_salud', 'flg_educ'], 'safe'],
            [['ruc'], 'string', 'max' => 12],
            [['name'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ruc' => 'Ruc',
            'name' => 'Name',
            'flg_bank' => 'Flg Bank',
            'flg_salud' => 'Flg Salud',
            'flg_educ' => 'Flg Educ',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}

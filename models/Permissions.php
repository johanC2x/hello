<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ospos_permissions".
 *
 * @property string $module_id
 * @property integer $person_id
 *
 * @property OsposEmployees $person
 * @property OsposModules $module
 */
class Permissions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ospos_permissions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['module_id', 'person_id'], 'required'],
            [['person_id'], 'integer'],
            [['module_id'], 'string', 'max' => 255],
            [['person_id'], 'exist', 'skipOnError' => true, 'targetClass' => OsposEmployees::className(), 'targetAttribute' => ['person_id' => 'person_id']],
            [['module_id'], 'exist', 'skipOnError' => true, 'targetClass' => OsposModules::className(), 'targetAttribute' => ['module_id' => 'module_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'module_id' => 'Module ID',
            'person_id' => 'Person ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(OsposEmployees::className(), ['person_id' => 'person_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModule()
    {
        return $this->hasOne(OsposModules::className(), ['module_id' => 'module_id']);
    }
}

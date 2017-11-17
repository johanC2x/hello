<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ospos_modules".
 *
 * @property string $name_lang_key
 * @property string $desc_lang_key
 * @property integer $sort
 * @property string $module_id
 *
 * @property OsposPermissions[] $osposPermissions
 * @property OsposEmployees[] $people
 */
class Modules extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ospos_modules';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_lang_key', 'desc_lang_key', 'sort', 'module_id'], 'required'],
            [['sort'], 'integer'],
            [['name_lang_key', 'desc_lang_key', 'module_id'], 'string', 'max' => 255],
            [['desc_lang_key'], 'unique'],
            [['name_lang_key'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name_lang_key' => 'Name Lang Key',
            'desc_lang_key' => 'Desc Lang Key',
            'sort' => 'Sort',
            'module_id' => 'Module ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOsposPermissions()
    {
        return $this->hasMany(OsposPermissions::className(), ['module_id' => 'module_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeople()
    {
        return $this->hasMany(OsposEmployees::className(), ['person_id' => 'person_id'])->viaTable('ospos_permissions', ['module_id' => 'module_id']);
    }
}

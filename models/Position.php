<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ospos_position".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $deleted
 * @property string $created_at
 * @property string $updated_at
 * 
 * @property OsposPosition[] $osposPosition
 */
class Position extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ospos_position';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['deleted'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 200],
            [['description'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(){
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'deleted' => 'Deleted',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    
    public function getOsposEmployees(){
        return $this->hasMany(Employees::className(), ['position_id' => 'id']);
    }
    
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ospos_code".
 *
 * @property integer $id
 * @property string $name
 * @property string $key
 * @property string $type
 * @property string $data
 * @property string $created_at
 * @property string $updated_at
 * 
 * @property People $people
 * 
 */
class Code extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ospos_code';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'key', 'type', 'data'], 'required'],
            [['data'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'key', 'type'], 'string', 'max' => 1000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'key' => 'Key',
            'type' => 'Type',
            'data' => 'Data',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    
    public function getPeople(){
        return $this->hasMany(People::className(), ['document_id' => 'id']);
    }
    
}

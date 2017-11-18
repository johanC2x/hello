<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ospos_inventory".
 *
 * @property integer $trans_id
 * @property integer $trans_items
 * @property integer $trans_user
 * @property string $trans_date
 * @property string $trans_comment
 * @property integer $trans_inventory
 *
 * @property OsposItems $transItems
 * @property OsposEmployees $transUser
 */
class Inventory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ospos_inventory';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trans_items', 'trans_user', 'trans_inventory'], 'integer'],
            [['trans_date'], 'safe'],
            [['trans_comment'], 'required'],
            [['trans_comment'], 'string'],
            [['trans_items'], 'exist', 'skipOnError' => true, 'targetClass' => OsposItems::className(), 'targetAttribute' => ['trans_items' => 'item_id']],
            [['trans_user'], 'exist', 'skipOnError' => true, 'targetClass' => OsposEmployees::className(), 'targetAttribute' => ['trans_user' => 'person_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'trans_id' => 'Trans ID',
            'trans_items' => 'Trans Items',
            'trans_user' => 'Trans User',
            'trans_date' => 'Trans Date',
            'trans_comment' => 'Trans Comment',
            'trans_inventory' => 'Trans Inventory',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransItems()
    {
        return $this->hasOne(OsposItems::className(), ['item_id' => 'trans_items']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransUser()
    {
        return $this->hasOne(OsposEmployees::className(), ['person_id' => 'trans_user']);
    }
}

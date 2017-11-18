<?php

namespace app\models;

use Yii;
use app\models\People;
use app\models\Items;
use app\models\Receivings;

/**
 * This is the model class for table "ospos_suppliers".
 *
 * @property integer $person_id
 * @property string $company_name
 * @property string $account_number
 * @property integer $deleted
 *
 * @property OsposItems[] $osposItems
 * @property OsposReceivings[] $osposReceivings
 * @property OsposPeople $person
 */
class Suppliers extends \yii\db\ActiveRecord{
    /**
     * @inheritdoc
     */
    public static function tableName(){
        return 'ospos_suppliers';
    }

    /**
     * @inheritdoc
     */
    public function rules(){
        return [
            [['person_id', 'company_name'], 'required'],
            [['person_id', 'deleted'], 'integer'],
            [['company_name', 'account_number'], 'string', 'max' => 255],
            [['account_number'], 'unique'],
            [['person_id'], 'exist', 'skipOnError' => true, 'targetClass' => People::className(), 'targetAttribute' => ['person_id' => 'person_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(){
        return [
            'person_id' => 'Person ID',
            'company_name' => 'Company Name',
            'account_number' => 'Account Number',
            'deleted' => 'Deleted',
        ];
    }
    
    public static function primaryKey(){
        return ['person_id','account_number'];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOsposItems(){
        return $this->hasMany(Items::className(), ['supplier_id' => 'person_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOsposReceivings(){
        return $this->hasMany(Receivings::className(), ['supplier_id' => 'person_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson(){
        return $this->hasOne(People::className(), ['person_id' => 'person_id']);
    }
    
    /* ======================== ACTIONS ============================= */
    
    public function getList(){
        $listSupplier = Suppliers::find()
                        ->joinWith(['person'])
                        ->all();
        return $listSupplier;
    }
    
    /* ============================================================== */
    
}

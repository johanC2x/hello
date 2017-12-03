<?php

namespace app\models;

use Yii;
use app\models\People;
use app\models\Inventory;
use app\models\Permissions;
use app\models\Modules;
use app\models\Receivings;
use app\models\Sales;
use app\models\SalesSuspended;

/**
 * This is the model class for table "ospos_employees".
 *
 * @property string $username
 * @property string $password
 * @property integer $person_id
 * @property integer $deleted
 * @property string $data
 * @property integer $position_id
 * @property string $code
 * @property integer $prueba
 * @property string $date_start
 * @property string $date_end
 * @property string $created_at
 * @property string $updated_at
 *
 * @property OsposPeople $person
 * @property OsposPosition $position
 * @property OsposInventory[] $osposInventories
 * @property OsposPermissions[] $osposPermissions
 * @property OsposModules[] $modules
 * @property OsposReceivings[] $osposReceivings
 * @property OsposSales[] $osposSales
 * @property OsposSalesSuspended[] $osposSalesSuspendeds
 */
class Employees extends \yii\db\ActiveRecord{
    
    public static function tableName(){
        return 'ospos_employees';
    }

    public function rules(){
        return [
            [['username', 'password', 'person_id'], 'required'],
            [['person_id', 'deleted'], 'integer'],
            //[['data'], 'safe'],
            [['username', 'password'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['prueba','data','created_at', 'updated_at','position_id','date_start','date_end'], 'safe'],
            [['person_id'], 'exist', 'skipOnError' => true, 'targetClass' => People::className(), 'targetAttribute' => ['person_id' => 'person_id']],
        ];
    }

    public function attributeLabels(){
        return [
            'username' => 'Username',
            'password' => 'Password',
            'person_id' => 'Person ID',
            'deleted' => 'Deleted',
        ];
    }

    public function getPerson(){
        return $this->hasOne(People::className(), ['person_id' => 'person_id']);
    }
    
    public function getPosition(){
        return $this->hasOne(Position::className(), ['position_id' => 'id']);
    }

    public function getOsposInventories(){
        return $this->hasMany(Inventory::className(), ['trans_user' => 'person_id']);
    }

    public function getOsposPermissions(){
        return $this->hasMany(Permissions::className(), ['person_id' => 'person_id']);
    }

    public function getModules(){
        return $this->hasMany(Modules::className(), ['module_id' => 'module_id'])->viaTable('ospos_permissions', ['person_id' => 'person_id']);
    }

    public function getOsposReceivings(){
        return $this->hasMany(Receivings::className(), ['employee_id' => 'person_id']);
    }

    public function getOsposSales(){
        return $this->hasMany(Sales::className(), ['employee_id' => 'person_id']);
    }

    public function getOsposSalesSuspendeds(){
        return $this->hasMany(SalesSuspended::className(), ['employee_id' => 'person_id']);
    }
    
}

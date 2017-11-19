<?php

namespace app\service;

use app\models\Entity;

class EntityService {
    
    public function getList() {
        $listEntity = Entity::find()
                     ->where(['status' => 0])
                     ->all();
        return $listEntity;
    }
    
    public function getListBank() {
        $listEntity = Entity::find()
                     ->where(['status' => 0])
                     ->andWhere(['flg_bank' => 1])
                     ->all();
        return $listEntity;
    }
    
    public function getListSalud() {
        $listEntity = Entity::find()
                     ->where(['status' => 0])
                     ->andWhere(['flg_salud' => 1])
                     ->all();
        return $listEntity;
    }
    
    public function getEntity($ruc = null){
        $entity = Entity::find()->from("ospos_entity e")
                     ->where(['e.ruc' => $ruc])
                     ->one();
        return $entity;
    }
    
}

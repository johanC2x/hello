<?php

namespace app\service;

use app\models\Code;

class CodeService {
    
    public function getCodeByType($type = null){
        $employees = Code::find()->from("ospos_code c")
                     ->where(['c.type' => $type])
                     ->all();
        return $employees;
    }
    
    public function getCodeByTypeAndKey($type = null,$key = null){
        $employees = Code::find()->from("ospos_code c")
                     ->where(['c.type' => $type])
                     ->andWhere(['c.key' => $key])
                     ->all();
        return $employees;
    }
    
}

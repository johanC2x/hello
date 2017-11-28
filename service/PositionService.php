<?php

namespace app\service;

use app\models\Position;

class PositionService {
    
    public function getList(){
        $listPosition = Position::find()
                        ->where(['deleted' => 0])
                        ->all();
        return $listPosition;
    }
    
}

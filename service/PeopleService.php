<?php

namespace app\service;

use app\models\People;

class PeopleService {
    
    public function getPeople($person_id = null){
        $people = People::find()->from("ospos_people e")
                     ->where(['e.person_id' => $person_id])
                     ->one();
        return $people;
    }
    
}

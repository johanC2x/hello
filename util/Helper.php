<?php

namespace app\util;
use app\service\EntityService;

trait Helper {
    
    public function listMonth(){
        $month = array(
            1 => "ENERO",
            2 => "FEBRERO",
            3 => "MARZO",
            4 => "ABRIL",
            5 => "MAYO",
            6 => "JUNIO",
            7 => "JULIO",
            8 => "AGOSTO",
            9 => "SETIEMBRE",
            10 => "OCTUBRE",
            11 => "NOVIEMBRE",
            12 => "DICIEMBRE"
        );
        return $month;
    }
    
}

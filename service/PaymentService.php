<?php

namespace app\service;

use \app\models\Payment;

class PaymentService {
 
    public function getList(){
        $listPayment = Payment::find()->all();
        return $listPayment;
    }
    
    public function getListByEmployee($employee_id){
        $listPayment = Payment::find()->from("ospos_payment p")
                     ->where(['p.employee_id' => $employee_id])
                     ->all();
        return $listPayment;
    }
    
}

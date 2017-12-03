<?php

namespace app\service;

use \app\models\Payment;

class PaymentService {
 
    public function getList(){
        $listPayment =  Payment::find()->joinWith(['employee e' => function($q){
                            $q->where(['e.deleted' => 0]);
                        }])->all();
        return $listPayment;
    }
    
    public function getListByEmployee($employee_id){
        $listPayment = Payment::find()->from("ospos_payment p")
                     ->joinWith(['employee'])
                     ->where(['p.employee_id' => $employee_id])
                     ->all();
        return $listPayment;
    }
    
}

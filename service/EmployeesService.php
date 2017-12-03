<?php

namespace app\service;

use app\models\People;
use \app\models\Payment;
use app\models\Employees;
use app\service\PeopleService;

class EmployeesService {

    public function getList() {
        $listEmployees = Employees::find()
                ->joinWith(['person'])
                ->where(['deleted' => 0])
                ->all();
        return $listEmployees;
    }
    
    public function getListFilter($ruc = null,$nro = null,$año = null,$mes = null){
        $query = (new \yii\db\Query());
        $query->select("*")->from('ospos_employees e');
        $query->where("e.deleted = 0");
        if($ruc){
            $query->andWhere("JSON_CONTAINS(e.data->"."\""."$"."\"".", '{"."\""."ruc"."\"".":"."\"".$ruc."\""."}')");
        }
        if($nro){
            $query->andWhere("JSON_CONTAINS(e.data->"."\""."$"."\"".", '{"."\""."number"."\"".":"."\"".$nro."\""."}')");
        }
        if($año){
            $query->andWhere("JSON_CONTAINS(e.data->"."\""."$.payment_account"."\"".", '{"."\""."year"."\"".":"."\"".$año."\""."}')");
        }
        if($mes){
            $query->andWhere("JSON_CONTAINS(e.data->"."\""."$.payment_account"."\"".", '{"."\""."month"."\"".":"."\"".$mes."\""."}')");
        }
        $command = $query->createCommand();
        $result = $command->queryAll();
        return $result;
    }
    
    public function getEmployee($person_id = null) {
        $employees = Employees::find()->from("ospos_employees e")
                     ->joinWith(['person'])
                     ->where(['e.person_id' => $person_id])
                     ->andWhere(['e.deleted' => 0])
                     ->one();
        return $employees;
    }
    
    public function getMaxCode(){
        $code= Employees::find()->from("ospos_employees")->where(['deleted' => 0])->max('code');
        return $code;
    }

    public function insertEmployees($data = null) {
        /* INSERT PEOPLE */
        $people = new People();
        $people->person_id = $data["person_id"];
        $people->first_name = $data["first_name"];
        $people->last_name = $data["last_name"];
        $people->email = $data["email"];
        $people->phone_number = $data["phone_number"];
        $people->address_1 = $data["address_1"];
        $people->document_id = $data["type_document"];
        $statusPerson = $people->save();
        
        /* INSERT EMPLOYEE */
        $employees = new Employees();
        $employees->username = $data["person_id"];
        $employees->password = "202cb962ac59075b964b07152d234b70";
        $employees->person_id = $people->person_id;
        $employees->position_id = $data["postion_id"];
        $employees->code = isset($data["code"]) ? $data["code"] : ($this->getMaxCode() + 1);
        $employees->prueba = (int)$data["flg_prueba"];
        $employees->data = $data["data_employee"];
        $employees->date_start = date('Y-m-d',strtotime($data["date_start"]));
        $employees->date_end = date('Y-m-d',strtotime($data["date_end"]));
        $statusEmployees = $employees->save();
        
        /* INSERT PAYMENT */
        $month = 0;
        $date_loop = (int)abs((strtotime($data["date_start"]) - strtotime($data["date_end"]))/(60*60*24*30));
        if($date_loop > 0){
            if(date('Y',strtotime($data["date_start"])) === date('Y',strtotime($data["date_end"]))){
                $month = date('m',strtotime($data["date_start"]));
                for($i = $month; $i<= 12; $i++){
                    $payment = new Payment();
                    $payment->employee_id = $people->person_id;
                    $payment->month = $i;
                    $payment->year = date('Y',strtotime($data["date_start"]));
                    $payment->payment_sol = $data["pay_sol"];
                    $payment->payment_dol = $data["pay_dol"];
                    $payment->payment_dscto = 0;
                    $payment->cuentad = 4111;
                    $payment->cuentah = 1041;
                    $payment->save();
                }
            }else{
                $month = date('m',strtotime($data["date_start"]));
                for($i = $month; $i<= 12; $i++){
                    $payment = new Payment();
                    $payment->employee_id = $people->person_id;
                    $payment->month = $i;
                    $payment->year = date('Y',strtotime($data["date_start"]));
                    $payment->payment_sol = $data["pay_sol"];
                    $payment->payment_dol = $data["pay_dol"];
                    $payment->payment_dscto = 0;
                    $payment->cuentad = 4111;
                    $payment->cuentah = 1041;
                    $payment->code_state_payment = 7;
                    $payment->save();
                }
                $month_end = date('m',strtotime($data["date_end"]));
                for($j = 1; $j<= $month_end; $j++){
                    $payment = new Payment();
                    $payment->employee_id = $people->person_id;
                    $payment->month = $j;
                    $payment->year = date('Y',strtotime($data["date_end"]));
                    $payment->payment_sol = $data["pay_sol"];
                    $payment->payment_dol = $data["pay_dol"];
                    $payment->payment_dscto = 0;
                    $payment->cuentad = 4111;
                    $payment->cuentah = 1041;
                    $payment->code_state_payment = 7;
                    $payment->save();
                }
            }
        }
        if ($statusPerson && $statusEmployees) {
            return ["success" => true, "data" => $statusPerson];
        } else {
            return ["success" => false, "data" => []];
        }
    }

    public function updateEmployee($data = null) {
        $peopleService = new PeopleService();
        $people = $peopleService->getPeople($data["person_id"]);
        $people->person_id = $data["person_id"];
        $people->first_name = $data["first_name"];
        $people->last_name = $data["last_name"];
        $people->email = $data["email"];
        $people->phone_number = $data["phone_number"];
        $people->address_1 = $data["address_1"];
        $statusPerson = $people->save();
        $employees = $this->getEmployee($data["person_id"]);
        $employees->data = $data["data_employee"];
        $statusEmployees = $employees->save();
        if ($statusPerson && $statusEmployees) {
            return ["success" => true, "data" => $statusPerson];
        } else {
            return ["success" => false, "data" => []];
        }
    }
    
    public function updateEmployeeData($data = null){
        $employees = $this->getEmployee($data["person_id"]);
        $employees->data = $data["data_employee"];
        $statusEmployees = $employees->save();
        if ($statusEmployees) {
            return ["success" => true, "data" => $statusEmployees];
        } else {
            return ["success" => false, "data" => []];
        }
    }
    
    public function deleteEmployee($person_id = null){
        $employee = $this->getEmployee($person_id);
        if(sizeof($employee) > 0){
            $employee->deleted = 1;
            $statusEmployees = $employee->save();
             if ($statusEmployees) {
                return ["success" => true, "data" => $statusEmployees];
            } else {
                return ["success" => false, "data" => []];
            }
        }else{
            return ["success" => false, "data" => []];
        }
    }

}

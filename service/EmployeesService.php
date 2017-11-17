<?php

namespace app\service;

use app\models\People;
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

    public function getEmployee($person_id = null) {
        $employees = Employees::find()->from("ospos_employees e")
                ->joinWith(['person'])
                ->where(['e.person_id' => $person_id])
                ->one();
        return $employees;
    }

    public function insertEmployees($data = null) {
        $people = new People();
        $people->person_id = $data["person_id"];
        $people->first_name = $data["first_name"];
        $people->last_name = $data["last_name"];
        $people->email = $data["email"];
        $people->phone_number = $data["phone_number"];
        $people->address_1 = $data["address_1"];
        $statusPerson = $people->save();
        $employees = new Employees();
        $employees->username = $data["person_id"];
        $employees->password = "202cb962ac59075b964b07152d234b70";
        $employees->person_id = $people->person_id;
        $statusEmployees = $employees->save();
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
        if ($statusPerson) {
            return ["success" => true, "data" => $statusPerson];
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

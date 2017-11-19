<?php

namespace app\controllers;

use Yii;
use app\service\EmployeesService;
use app\service\EntityService;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\filters\ContentNegotiator;

class EmployeesController extends Controller{
    
    private $_listEmployees = [];
    private $_listEntity = [];
    private $_employee = null;
    public $enableCsrfValidation = false;
    
    public function behaviors(){
        $this->layout = "main_ysumma";
        return [
            'contentNegotiator' => [
                'class' => ContentNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
                'only' => ['register'],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    
    public function actionIndex(){
        $employeesService = new EmployeesService();
        $this->_listEmployees = $employeesService->getList();
        return $this->render('index', [
            'listEmployees' => $this->_listEmployees
        ]);
    }
    
    public function actionView(){
        $entityService = new EntityService();
        $employeesService = new EmployeesService();
        $id_employee = isset($_GET["employee"]) && !empty($_GET["employee"]) ? $_GET["employee"]:false;
        $this->_listEntity = $entityService->getListBank();
        if($id_employee){
            $this->_employee = $employeesService->getEmployee($id_employee);
            return $this->render('update',[
                "employee" => $this->_employee,
                'listEntity' => $this->_listEntity
            ]);
        }else{
            return $this->render('create',[
                'listEntity' => $this->_listEntity
            ]);
        }
    }
    
    public function actionSave(){
        $response = [];
        $employeesService = new EmployeesService();
        if (Yii::$app->request->post()) {
            $data = Yii::$app->request->post();
            if(sizeof($data) > 0 && !empty($data)){
                $employee = $employeesService->getEmployee($data["person_id"]);
                if(sizeof($employee) > 0){
                    $response = ["success" => false, "response" => "El empleado ingresado actualmente existe"];
                }else{
                    $result = $employeesService->insertEmployees($data);
                    $response = ($result["success"]) ? ["success" => true , "response" => "Operación Correcta"] : ["success" => false , "response" => "Error"];
                }
            }else{
                $response = ["success" => false , "response" => "Error"];
            }
        }else{
            $response = ["success" => false , "response" => "Error"];
        }
        return json_encode($response);
    }
    
    public function actionUpdate(){
        $response = [];
        $employeesService = new EmployeesService();
        if (Yii::$app->request->post()) {
            $data = Yii::$app->request->post();
            if(sizeof($data) > 0 && !empty($data)){
                $result = $employeesService->updateEmployee($data);
                $response = ($result["success"]) ? ["success" => true , "response" => "Operación Correcta"] : ["success" => false , "response" => "Error"];
            }else{
                $response = ["success" => false , "response" => "Error"];
            }
        }else{
            $response = ["success" => false , "response" => "Error"];
        }
        return json_encode($response);
    }
    
    public function actionUpdatedata(){
        $response = [];
        $employeesService = new EmployeesService();
        if (Yii::$app->request->post()) {
            $data = Yii::$app->request->post();
            if(sizeof($data) > 0 && !empty($data)){
                $result = $employeesService->updateEmployeeData($data);
                $response = ($result["success"]) ? ["success" => true , "response" => "Operación Correcta"] : ["success" => false , "response" => "Error"];
            }else{
                $response = ["success" => false , "response" => "Error"];
            }
        }else{
            $response = ["success" => false , "response" => "Error"];
        }
        return json_encode($response);
    }
    
    public function actionDelete(){
        $employeesService = new EmployeesService();
        $id_employee = isset($_POST["employee_delete"]) && !empty($_POST["employee_delete"]) ? $_POST["employee_delete"]:false;
        if($id_employee){
            $employeesService->deleteEmployee($id_employee);
        }
        return $this->redirect(['employees/index']);
    }
    
    public function actionPayment(){
        $employeesService = new EmployeesService();
        $entityService = new EntityService();
        $id_employee = isset($_GET["employee"]) && !empty($_GET["employee"]) ? $_GET["employee"]:false;
        if($id_employee){
            $entity = false;
            $this->_employee = $employeesService->getEmployee($id_employee);
            $data = isset($this->_employee->data) ? json_decode($this->_employee->data) : "";
            if(!empty($data)){
                $entity = $entityService->getEntity($data->ruc);
            }
            return $this->render('payment',[
                "employee" => $this->_employee,
                'entity' => $entity
            ]);
        }
    }
    
    public function actionGetemployee(){
        $employeesService = new EmployeesService();
        $id_employee = isset($_GET["employee"]) && !empty($_GET["employee"]) ? $_GET["employee"]:false;
        $this->_listEmployees = $employeesService->getList();
        if($id_employee){
            $this->_employee = $employeesService->getEmployee($id_employee);
            Yii::$app->session->setFlash('viewEmployee');
            return $this->render('index',[
                "employee" => $this->_employee,
                'listEmployees' => $this->_listEmployees
            ]);
        }else{
            return $this->render('index',[
                "employee" => false,
                'listEmployees' => $this->_listEmployees
            ]);
        }
    }
    
}

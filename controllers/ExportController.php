<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\service\EmployeesService;
use app\service\CodeService;
use app\service\EntityService;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\filters\ContentNegotiator;
use app\util\Helper as helper;

class ExportController extends Controller{
    
    use helper;
    
    private $_listEmployees = [];
    private $_listEntityBank = [];
    private $_listMonth = [];
    
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
        $entityService = new EntityService();
        $this->_listEmployees = $employeesService->getList();
        $this->_listEntityBank = $entityService->getListBank();
        $this->_listMonth = $this->listMonth();
        return $this->render('index', [
            'listEmployees' => $this->_listEmployees,
            'listEntityBank' => $this->_listEntityBank,
            'listMonth' => $this->_listMonth
        ]);
    }
    
    public function actionFilter(){
        $employeesService = new EmployeesService();
        $entityService = new EntityService();
        $ruc = (isset($_GET["ruc"]) && !empty($_GET["ruc"])) ? $_GET["ruc"]:false;
        $nro = (isset($_GET["nrocuenta"]) && !empty($_GET["nrocuenta"])) ? $_GET["nrocuenta"]:false;
        $año = (isset($_GET["year"]) && !empty($_GET["year"])) ? $_GET["year"]:false;
        $mes = (isset($_GET["month"]) && !empty($_GET["month"])) ? $_GET["month"]:false;
        $result = $employeesService->getListFilter($ruc, $nro, $año, $mes);
        $this->_listEmployees = $result;
        $this->_listEntityBank = $entityService->getListBank();
        $this->_listMonth = $this->listMonth();
        return $this->render('search', [
            'listEmployees' => $this->_listEmployees,
            'listEntityBank' => $this->_listEntityBank,
            'listMonth' => $this->_listMonth
        ]);
    }
    
    public function actionGetexportfile(){
        header('Content-Type: text/txt; charset=utf-8');
        header('Content-Disposition: attachment; filename=data.txt');
        $output = fopen('php://output', 'w');
        $codeService = new CodeService();
        $employeesService = new EmployeesService();
        $listEmployee = $employeesService->getList();
        //$listCodeHead = $codeService->getCodeByTypeAndKey("file_export","file-head-bcp");
        $listCodeDetail = $codeService->getCodeByTypeAndKey("file_export","file-detail-bcp");
        $dataDetail = json_decode($listCodeDetail[0]->data);
        $detail = "";
        foreach ($listEmployee as $employee){
            if(sizeof($dataDetail->file_detail_bcp->content) > 0){
                $detail .= isset($dataDetail->file_detail_bcp->content[0]->default) ? str_repeat(" ",($dataDetail->file_detail_bcp->content[0]->length - strlen($dataDetail->file_detail_bcp->content[0]->default))).$dataDetail->file_detail_bcp->content[0]->default : "";
                $detail .= isset(json_decode($employee->data)->number) && !empty(json_decode($employee->data)->number) ? 
                            json_decode($employee->data)->number.str_repeat(" ",($dataDetail->file_detail_bcp->content[1]->length - strlen(json_decode($employee->data)->number))): 
                                "".str_repeat(" ",($dataDetail->file_detail_bcp->content[1]->length - strlen("")));
                $detail .= "1";
                $detail .= str_repeat(" ",($dataDetail->file_detail_bcp->content[3]->length - strlen($employee->person_id))).$employee->person_id;
                $detail .= str_repeat(" ",$dataDetail->file_detail_bcp->content[4]->length);
                $detail .= str_repeat(" ",$dataDetail->file_detail_bcp->content[5]->length - strlen($employee->person->first_name.$employee->person->last_name)).$employee->person->first_name.$employee->person->last_name;
                $detail .= str_repeat(" ",$dataDetail->file_detail_bcp->content[6]->length);
                $detail .= str_repeat(" ",$dataDetail->file_detail_bcp->content[7]->length);
                $detail .= isset($dataDetail->file_detail_bcp->content[8]->default) ? str_repeat(" ",($dataDetail->file_detail_bcp->content[8]->length - strlen($dataDetail->file_detail_bcp->content[8]->default))).$dataDetail->file_detail_bcp->content[8]->default : "";
                $detail .= str_repeat("0",($dataDetail->file_detail_bcp->content[9]->length - strlen(json_decode($employee->data)->payment->pay_sol))).json_decode($employee->data)->payment->pay_sol."\n";
            }
        }
        fputs($output, $detail);
        Yii::$app->end();
    }
    
}

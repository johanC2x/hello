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
    
}

<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\service\EmployeesService;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\filters\ContentNegotiator;

class ExportController extends Controller{
    
    private $_listEmployees = [];
    
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
    
    public function actionGetexportfile(){
        header('Content-Type: text/txt; charset=utf-8');
        header('Content-Disposition: attachment; filename=data.txt');
        $output = fopen('php://output', 'w');
        Yii::$app->end();
    }
    
}

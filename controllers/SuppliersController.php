<?php

namespace app\controllers;

use Yii;
use app\models\Suppliers;
use app\models\SuppliersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class SuppliersController extends Controller{
    
    private $_listSuplliers = [];
    
    public function behaviors(){
        $this->layout = "main_ysumma";
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex(){
        $model = new Suppliers();
        $suppliers = new Suppliers();
        $this->_listSuplliers = $suppliers->getList();
        return $this->render('index_new', [
            'model' => $model,
            'listSuplliers' => $this->_listSuplliers
        ]);
    }
    
    public function actionIndexold(){
        $this->layout = "main";
        $searchModel = new SuppliersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($person_id, $account_number){
        return $this->render('view', [
            'model' => $this->findModel($person_id, $account_number),
        ]);
    }

    public function actionCreate(){
        $model = new Suppliers();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'person_id' => $model->person_id, 'account_number' => $model->account_number]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($person_id, $account_number){
        $model = $this->findModel($person_id, $account_number);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'person_id' => $model->person_id, 'account_number' => $model->account_number]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($person_id, $account_number){
        $this->findModel($person_id, $account_number)->delete();
        return $this->redirect(['index']);
    }

    protected function findModel($person_id, $account_number){
        if (($model = Suppliers::findOne(['person_id' => $person_id, 'account_number' => $account_number])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

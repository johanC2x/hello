<?php

use yii\web\View;
use yii\helpers\Url;

$this->title = 'YSUMMA';
$this->registerJsFile('https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js', ['position' => View::POS_END]);
$this->registerJsFile(Yii::getAlias('@web') . '/lib/employees/employeesController.js?v1', ['position' => View::POS_END]);
$this->registerJsFile(Yii::getAlias('@web') . '/lib/employees/employeesModel.js?v1', ['position' => View::POS_END]);
?>
<div class="row">
    <div class="col-md-12">
        <ul class="breadcrumb"><li><a href="<?= Url::to(['/']); ?>">Home</a></li>
            <li class="active"><a href="<?= Url::to(['employees/index']); ?>">Empleados</a></li>
            <li class="active">Modificar Empleado</li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <form id="frm_employees" method="POST" action="<?= Url::to(['employees/update']); ?>" >
                    <div class="form-group">
                        <label>DNI</label>
                        <input type="text" id="person_id" name="person_id" class="form-control" value="<?= $employee->person->person_id; ?>" >
                    </div>
                    <div class="row">                
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nombres</label>
                                <input type="text" id="first_name" name="first_name" class="form-control" value="<?= $employee->person->first_name; ?>" >
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Apellidos</label>
                                <input type="text" id="last_name" name="last_name" class="form-control" value="<?= $employee->person->last_name; ?>" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" id="email" name="email" class="form-control" value="<?= $employee->person->email; ?>" >
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Teléfono</label>
                                <input type="text" id="phone_number" name="phone_number" class="form-control" value="<?= $employee->person->phone_number; ?>" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Dirección</label>
                        <input type="text" id="address_1" name="address_1" class="form-control" value="<?= $employee->person->address_1; ?>" >
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
                <div id="messages"></div>
            </div>
        </div>
    </div>
</div>
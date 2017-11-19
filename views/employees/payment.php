<?php

use yii\web\View;
use yii\helpers\Url;

$this->title = 'YSUMMA';
$this->registerJsFile('https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js', ['position' => View::POS_END]);
$this->registerJsFile(Yii::getAlias('@web') . '/lib/employees/employeesController.js?v1', ['position' => View::POS_END]);
$this->registerJsFile(Yii::getAlias('@web') . '/lib/employees/employeesModel.js?v1', ['position' => View::POS_END]);
$data = json_decode($employee->data);
//echo json_encode($data->payment);exit();
$dataEntity = json_decode($entity->data);
?>
<div class="row">
    <div class="col-md-12">
        <ul class="breadcrumb"><li><a href="<?= Url::to(['/']); ?>">Home</a></li>
            <li class="active"><a href="<?= Url::to(['employees/index']); ?>">Empleados</a></li>
            <li class="active">Agregar Pagos</li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <form id="frm_employees_pay" method="POST" action="<?= Url::to(['employees/updatedata']); ?>" >
                    <div class="row">                
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>DNI</label>
                                <input type="text" id="person_id" name="person_id" class="form-control" value="<?= $employee->person->person_id; ?>" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Nombres</label>
                                <input type="text" id="first_name" name="first_name" class="form-control" value="<?= $employee->person->first_name; ?>" disabled="true"/>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Apellidos</label>
                                <input type="text" id="last_name" name="last_name" class="form-control" value="<?= $employee->person->last_name; ?>" disabled="true"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Banco</label>
                                <?php $bank = (isset($data->bank) && !empty($data->bank)) ? $data->bank : ""; ?>
                                <?php $ruc = (isset($data->ruc)) ? $data->ruc : ""; ?>
                                <input id="cbo_entity" name="cbo_entity" type="text" data-ruc="<?= $ruc; ?>" value="<?= $bank; ?>" class="form-control" disabled="true"/>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Número de Cuenta</label>
                                <?php $number = (isset($data->number) && !empty($data->number)) ? $data->number : ""; ?>
                                <?php $number_length = (isset($data->number_length) && !empty($data->number_length)) ? $data->number_length : 0; ?>
                                <input type="text" id="number_account" name="number_account" class="form-control" maxlength="<?= $number_length; ?>" data-number="<?= $number_length; ?>" value="<?= $number; ?>" disabled="true"/>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label>Cuenta Banco</label>
                            <?php if(isset($dataEntity->account) && sizeof($dataEntity->account) > 0){ ?>
                                <select id="cbo_entity_account" name="cbo_entity_account" class="form-control" >
                                    <option value="" >Seleccionar</option>
                                    <?php foreach ($dataEntity->account as $account){ ?>
                                        <?php $selected = (isset($data->payment->account) && $data->payment->account === $account->value->account) ? "selected" : ""; ?>
                                        <option value="<?= $account->value->account; ?>" <?= $selected; ?> >
                                            <?= $account->value->account; ?> - <?= strtoupper($account->value->name); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Retenciones</label><br/>
                                <label class="checkbox-inline">
                                    <?php $ck_ct = isset($data->payment->ret_ct) && $data->payment->ret_ct ? "checked" : ""; ?>
                                    <input id="ck_pay_ct" name="ck_pay_ct" type="checkbox" value="" <?= $ck_ct; ?> >
                                Retención de 4°</label>
                                <label class="checkbox-inline">
                                    <?php $ck_qt = isset($data->payment->ret_qt) && $data->payment->ret_qt ? "checked" : ""; ?>
                                    <input id="ck_pay_qt" name="ck_pay_qt" type="checkbox" value="" <?= $ck_qt; ?> >
                                Retención de 5°</label>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Pago Soles</label>
                                <input id="payment_sol" name="payment_sol" type="number" class="form-control"
                                       value="<?= isset($data->payment->pay_sol) ? $data->payment->pay_sol : ""; ?>"
                                       min="0.00" step="0.01"/>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Pago Dólares</label>
                                <input id="payment_dol" name="payment_dol" type="number" class="form-control"
                                       value="<?= isset($data->payment->pay_dol) ? $data->payment->pay_dol : ""; ?>"
                                       min="0.00" step="0.01"/>
                            </div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Año</label>
                                <select id="cbo_year" name="cbo_entity_account" class="form-control" >
                                    <option value="" >Seleccionar</option>
                                    <option value="2016">2016</option>
                                    <option value="2017">2017</option>
                                    <option value="2018">2018</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Mes</label>
                                <select id="cbo_month" name="cbo_entity_account" class="form-control" >
                                    <option value="" >Seleccionar</option>
                                    <option value="1" >Enero</option>
                                    <option value="2" >Febrero</option>
                                    <option value="3" >Marzo</option>
                                    <option value="4" >Abril</option>
                                    <option value="5" >Mayo</option>
                                    <option value="6" >Junio</option>
                                    <option value="7" >Julio</option>
                                    <option value="8" >Agosto</option>
                                    <option value="9" >Setiembre</option>
                                    <option value="10" >Octubre</option>
                                    <option value="11" >Noviembre</option>
                                    <option value="12" >Diciembre</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <input id="data_employee" name="data_employee" type="hidden" />
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
                <div id="messages"></div>
            </div>
        </div>
    </div>
</div>
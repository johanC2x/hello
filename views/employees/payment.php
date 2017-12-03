<?php

use yii\web\View;
use yii\helpers\Url;
use app\util\Util;

$this->title = 'YSUMMA';
$this->registerJsFile('https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js', ['position' => View::POS_END]);
$this->registerJsFile(Yii::getAlias('@web') . '/lib/employees/employeesController.js?v1', ['position' => View::POS_END]);
$this->registerJsFile(Yii::getAlias('@web') . '/lib/employees/employeesModel.js?v1', ['position' => View::POS_END]);
$data = json_decode($employee->data);
$dataEntity = json_decode($entity->data);
$util = new Util();
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
                                <input id="person_id" name="person_id" type="hidden" value="<?= $employee->person->person_id; ?>"/>
                                <input type="text" class="form-control" value="<?= $employee->person->person_id; ?>" disabled="true"/>
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
                            <label>Cuenta Banco</label>
                            <?php if(isset($dataEntity->account) && sizeof($dataEntity->account) > 0){ ?>
                                <select id="cbo_entity_account" name="cbo_entity_account" class="form-control" >
                                    <option value="" >Seleccionar</option>
                                    <?php foreach ($dataEntity->account as $account){ ?>
                                        <option value="<?= $account->value->account; ?>">
                                            <?= $account->value->account; ?> - <?= strtoupper($account->value->name); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            <?php } ?>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Descuentos</label>
                                <select id="cbo_pay_ret" name="cbo_pay_ret" class="form-control" >
                                    <option value="" >Seleccionar</option>
                                    <option value="DR" data-name="Retención de 4° categoría">
                                        Descuentos de Rentas
                                    </option>
                                    <option value="DJ" data-name="Retención de 5° categoría">
                                        Descuentos Judiciales
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Retenciones</label>
                                <select id="cbo_pay_ret" name="cbo_pay_ret" class="form-control" >
                                    <option value="" >Seleccionar</option>
                                    <option value="R4" data-name="Retención de 4° categoría">
                                        Retención de 4° categoría
                                    </option>
                                    <option value="R5" data-name="Retención de 5° categoría">
                                        Retención de 5° categoría
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Pago Soles</label>
                                <input id="payment_sol" name="payment_sol" type="number" class="form-control" min="0.00" step="0.01"/>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Pago Dólares</label>
                                <input id="payment_dol" name="payment_dol" type="number" class="form-control" min="0.00" step="0.01"/>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label>Descuento</label>
                            <input id="payment_dscto" name="payment_dscto" type="number" class="form-control" min="0.00" step="0.01" value="0"/>
                        </div>
                    </div>
                    <input id="data_employee" name="data_employee" type="hidden" value='<?= json_encode($data); ?>'/>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
                <div id="messages"></div>
                <br/>
                <?php if(isset($listPayment) && sizeof($listPayment) > 0){ ?>
                    <table id="tbl_employees_payment" class="table table-bordered" >
                        <thead>
                            <tr>
                                <th>AÑO</th>
                                <th>MES</th>
                                <th>PAGO SOLES</th>
                                <th>PAGO DOLARES</th>
                                <th>DSCTO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $index = 0;?>
                            <?php foreach ($listPayment as $payment){?>
                                <tr>
                                    <td><?= isset($payment->year) ? $payment->year:""; ?></td>
                                    <td><?= isset($payment->month) ? $util->getMonth($payment->month):""; ?></td>
                                    <td><?= isset($payment->payment_sol) && !empty($payment->payment_sol) ? number_format($payment->payment_sol,2):number_format(0,2); ?></td>
                                    <td><?= isset($payment->payment_dol) && !empty($payment->payment_dol) ? number_format($payment->payment_dol,2):number_format(0,2); ?></td>
                                    <td><?= isset($payment->payment_dscto) && !empty($payment->payment_dscto) ? number_format($payment->payment_dscto,2):number_format(0,2); ?></td>
                                </tr>
                                <?php $index++;?>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } ?>
                <?php if(isset($data->payment_account) && sizeof($data->payment_account) > 0){ ?>
                <table id="tbl_employees_payment" class="table table-bordered" >
                    <thead>
                        <tr>
                            <th>CUENTA</th>
                            <th>AÑO</th>
                            <th>MES</th>
                            <th>RETENCIONES</th>
                            <th>PAGO SOLES</th>
                            <th>PAGO DOLARES</th>
                            <th>DSCTO</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $index = 0;?>
                        <?php foreach ($data->payment_account as $pay){?>
                            <tr>
                                <td><?= isset($pay->account) ? $pay->account:""; ?></td>
                                <td><?= isset($pay->year) ? $pay->year:""; ?></td>
                                <td><?= isset($pay->month) ? $util->getMonth($pay->month):""; ?></td>
                                <td><?= isset($pay->ret_name) && !empty($pay->ret_name) ? $pay->ret_name:""; ?></td>
                                <td><?= isset($pay->pay_sol) && !empty($pay->pay_sol) ? number_format($pay->pay_sol,2):number_format(0,2); ?></td>
                                <td><?= isset($pay->pay_dol) && !empty($pay->pay_dol) ? number_format($pay->pay_dol,2):number_format(0,2); ?></td>
                                <td><?= isset($pay->pay_dscto) && !empty($pay->pay_dscto) ? number_format($pay->pay_dscto,2):number_format(0,2); ?></td>
                                 <td>
                                    <center>
                                        <a onclick="employeesModel.deleteEmployeeData(<?=$index;?>)" href="javascript:void(0);" title="Eliminar">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </a>
                                    </center>
                                </td>
                            </tr>
                            <?php $index++;?>
                        <?php } ?>
                    </tbody>
                </table>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
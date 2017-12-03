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
            <li class="active">Nuevo Empleado</li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <form id="frm_employees" method="POST" action="<?= Url::to(['employees/save']); ?>" >
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group" >
                                <label>Tipo de Documento</label>
                                <select id="type_document" name="type_document" class="form-control" >
                                    <option value="" >Seleccionar</option>
                                    <?php if(sizeof($listTypeDocument) > 0){ ?>
                                        <?php foreach($listTypeDocument as $document){ ?>
                                            <option value="<?= $document->key; ?>" data-length="<?= json_decode($document->data)->number_length; ?>">
                                                <?= $document->name; ?>
                                            </option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>DNI</label>
                                <input type="text" id="person_id" name="person_id" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Codigo</label>
                                <input type="text" id="code" name="code" class="form-control" value="<?= ($codeEmployee + 1); ?>" data-code="<?= ($codeEmployee + 1); ?>"/>
                            </div>
                        </div>
                        <div class="col-lg-1">
                            <div class="form-group">
                                <br/>
                                <div class="checkbox checkbox-primary">
                                    <input id="code_generate" name="code_generate" class="styled" type="checkbox" checked="">
                                    <label for="code_generate">
                                        Generar
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <br/>
                                <div class="checkbox checkbox-primary">
                                    <input id="ck_prueba" name="ck_prueba" class="styled" type="checkbox" checked="">
                                    <label for="ck_prueba">
                                        En Prueba
                                    </label>
                                </div>
                            </div>
                        </div>
                        <input id="flg_prueba" name="flg_prueba" type="hidden" value="0" />
                    </div>
                    <div class="row">                
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nombres</label>
                                <input type="text" id="first_name" name="first_name" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Apellidos</label>
                                <input type="text" id="last_name" name="last_name" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Banco</label>
                                <select id="cbo_entity" name="cbo_entity" class="form-control">
                                    <option value="" >Seleccionar</option>
                                    <?php if(sizeof($listEntity) > 0){ ?>
                                        <?php foreach ($listEntity as $entity){ ?>
                                            <option value="<?= $entity->ruc; ?>" 
                                                    data-short="<?= $entity->name_short; ?>" 
                                                    data-number="<?= $entity->number_length; ?>"
                                                    data-account='<?= json_encode(json_decode($entity->data)->account); ?>'>
                                                <?= $entity->name; ?>
                                            </option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label>Cuenta Banco</label>
                            <select id="cbo_entity_account" name="cbo_entity_account" class="form-control">
                                <option value="" >Seleccionar</option>
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Número de Cuenta</label>
                                <input type="text" id="number_account" name="number_account" class="form-control" data-number="0" >
                            </div>
                        </div>
                    </div>
                    <div class="row" >
                        <div class="col-lg-6">
                            <div class="form-group" >
                                <label>Fecha de Inicio</label>
                                <div class="input-group date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                    <input id="date_start" name="date_start" class="form-control" size="16" type="text" value="" readonly="">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group" >
                                <label>Fecha de Fin</label>
                                <div class="input-group date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                    <input id="date_end" name="date_end" class="form-control" size="16" type="text" value="" readonly="">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group" >
                                <label>Cargo</label>
                                <select id="postion_id" name="postion_id" class="form-control" >
                                    <option value="" >Seleccionar</option>
                                    <?php if(sizeof($listPosition) > 0){ ?>
                                        <?php foreach($listPosition as $postion){ ?>
                                        <option value="<?= $postion->id; ?>"><?= $postion->name; ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group" >
                                <label>Pago Soles</label>
                                <input type="number" id="pay_sol" name="pay_sol" class="form-control" min="0.00" step="0.01" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group" >
                                <label>Pago Dólares</label>
                                <input type="number" id="pay_dol" name="pay_dol" class="form-control" min="0.00" step="0.01" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" id="email" name="email" class="form-control" >
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Teléfono</label>
                                <input type="text" id="phone_number" name="phone_number" class="form-control" >
                            </div>
                        </div>
                    </div>   
                    <div class="form-group">
                        <label>Dirección</label>
                        <input type="text" id="address_1" name="address_1" class="form-control" >
                        <!--<textarea id="address_1" name="address_1" class="form-control" cols="25" rows="5" ></textarea>-->
                    </div>
                    <input id="data_employee" name="data_employee" type="hidden" />
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
                <div id="messages"></div>
            </div>
        </div>
    </div>
</div>
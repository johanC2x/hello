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
        <ul class="breadcrumb"><li><a href="/">Home</a></li>
            <li class="active">Empleados</li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="<?= Url::to(['employees/view']); ?>" class="btn btn-primary">
                    Nuevo Empleado
                </a>
            </div>
            <div class="panel-body">
                <table id="tbl_employees" class="table table-bordered" >
                    <thead>
                        <tr>
                            <th>DNI</th>
                            <th>NOMBRES</th>
                            <th>NRO. CUENTA</th>
                            <th>BANCO</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (sizeof($listEmployees) > 0) { ?>
                            <?php foreach ($listEmployees as $employees) { ?>
                                <?php $data = json_decode($employees->data); ?>
                                <tr>
                                    <td><?= $employees->person_id ?></td>
                                    <td><?= $employees->person->first_name." ".$employees->person->last_name ?></td>
                                    <td><?= (isset($data->number) && !empty($data->number)) ? $data->number : ""; ?></td>
                                    <td><?= (isset($data->bank) && !empty($data->bank)) ? $data->bank : ""; ?></td>
                                    <td>
                                        <center>
                                            <a href="<?= Url::to(['employees/getemployee',"employee" => $employees->person_id]); ?>" title="Ver">
                                                <i class="fa fa-search" aria-hidden="true"></i>
                                            </a>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <a href="<?= Url::to(['employees/view',"employee" => $employees->person_id]); ?>" title="Editar">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <a href="<?= Url::to(['employees/payment',"employee" => $employees->person_id]); ?>" title="Agregar Pagos">
                                                <i class="fa fa-money" aria-hidden="true"></i>
                                            </a>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <a onclick="employeesModel.deleteEmployee(<?= $employees->person_id; ?>)" href="javascript:void(0);" title="Eliminar">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </a>
                                        </center>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ===== MODAL SUPPLIERS ======== -->
<div class="modal fade" id="modal_delete_employees" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
          <h4 class="modal-title">¿Seguro desea eliminar el siguiente registro?</h4>
          <form id="frm_delete_employees" method="POST" action="<?= Url::to(['employees/delete']); ?>" >
              <input id="employee_delete" name="employee_delete" type="hidden" />
          </form>
      </div>
      <div class="modal-footer">
        <button id="btn_delete_employee" type="submit" class="btn btn-info" data-dismiss="modal">SI</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
      </div>
    </div>
  </div>
</div>
<!-- ============================== -->

<!-- ===== MODAL SUPPLIERS DATA ======== -->
<?php if(isset($employee) && !empty($employee)){ ?>
<?php $data = json_decode($employee->data); ?>
<div class="modal fade" id="modal_data_employees" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Datos de Empleado</h4>
            </div>
            <div class="modal-body">
                <form role="form" >
                    <div class="form-group">
                        <label>DNI</label>
                        <input type="text" id="person_id" name="person_id" class="form-control" value="<?= $employee->person->person_id; ?>" disabled="true" />
                    </div>
                    <div class="row">                
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nombres</label>
                                <input type="text" id="first_name" name="first_name" class="form-control" value="<?= $employee->person->first_name; ?>" disabled="true" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Apellidos</label>
                                <input type="text" id="last_name" name="last_name" class="form-control" value="<?= $employee->person->last_name; ?>" disabled="true" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" id="email" name="email" class="form-control" value="<?= $employee->person->email; ?>" disabled="true" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Teléfono</label>
                                <input type="text" id="phone_number" name="phone_number" class="form-control" value="<?= $employee->person->phone_number; ?>" disabled="true" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Banco</label>
                                <?php $bank = (isset($data->bank) && !empty($data->bank)) ? $data->bank : ""; ?>
                                <input id="cbo_entity" name="cbo_entity" type="text" value="<?= $bank; ?>" class="form-control" disabled="true"/>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Número de Cuenta</label>
                                <?php $number = (isset($data->number) && !empty($data->number)) ? $data->number : ""; ?>
                                <?php $number_length = (isset($data->number_length) && !empty($data->number_length)) ? $data->number_length : 0; ?>
                                <input type="text" id="number_account" name="number_account" class="form-control" maxlength="<?= $number_length; ?>" data-number="<?= $number_length; ?>" value="<?= $number; ?>" disabled="true" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Dirección</label>
                        <textarea id="address_1" name="address_1" class="form-control" cols="25" rows="5" disabled="true">
                            <?= $employee->person->address_1; ?>
                        </textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<!-- =================================== -->

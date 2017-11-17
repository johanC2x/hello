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
                            <th></th>
                            <th>DNI</th>
                            <th>NOMBRES</th>
                            <th>TELÉFONO</th>
                            <th>DIRECCIÓN</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (sizeof($listEmployees) > 0) { ?>
                            <?php foreach ($listEmployees as $employees) { ?>
                                <tr>
                                    <td>
                                        <center>
                                            <a onclick="employeesModel.deleteEmployee(<?= $employees->person_id; ?>)" href="javascript:void(0);" title="Eliminar">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </a>
                                        </center>
                                    </td>
                                    <td><?= $employees->person_id ?></td>
                                    <td><?= $employees->person->first_name." ".$employees->person->last_name ?></td>
                                    <td><?= $employees->person->phone_number ?></td>
                                    <td><?= $employees->person->address_1 ?></td>
                                    <td>
                                        <center>
                                            <a href="<?= Url::to(['employees/view',"employee" => $employees->person_id]); ?>" title="Editar">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
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


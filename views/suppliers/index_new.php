<?php
    use yii\web\View;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;

    $this->title = 'YSUMMA';
    $this->registerJsFile(Yii::getAlias('@web') . '/lib/suppliers/suplliersController.js', ['position' => View::POS_END]);
    $this->registerJsFile(Yii::getAlias('@web') . '/lib/suppliers/suplliersModel.js', ['position' => View::POS_END]);
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<div class="row">
    <div class="col-md-12">
        <ul class="breadcrumb"><li><a href="/">Home</a></li>
            <li class="active">Proveedores</li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_suppliers">
                    Nuevo Proveedor
                </button>
            </div>
            <div class="panel-body">
                <table id="tbl_suplliers" class="table table-bordered table-responsive" >
                    <thead>
                        <tr>
                            <th>RUC</th>
                            <th>RAZÓN SOCIAL</th>
                            <th>TELÉFONO</th>
                            <th>DIRECCIÓN</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (sizeof($listSuplliers) > 0) { ?>
                            <?php foreach ($listSuplliers as $supllier) { ?>
                                <tr>
                                    <td><?= $supllier->person_id ?></td>
                                    <td><?= $supllier->company_name ?></td>
                                    <td><?= $supllier->person->phone_number ?></td>
                                    <td><?= $supllier->person->address_1 ?></td>
                                    <td></td>
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
<div class="modal fade" id="modal_suppliers" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Crear / Editar Proveedor</h4>
      </div>
      <div class="modal-body">
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'account_number')->textInput(['maxlength' => true])->label('Número de Ruc'); ?>
        <?= $form->field($model, 'company_name')->textInput(['maxlength' => true])->label('Razón Social'); ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Crear Proveedor' : 'Modificar Proveedor', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- ============================== -->

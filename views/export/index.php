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
            <li class="active">Exportar Pagos</li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTwo">
                <h4 class="panel-title">
                   <a role="button" data-toggle="collapse" href="#collapseTwo" 
                       aria-expanded="true" aria-controls="collapseTwo" class="trigger collapsed">
                        Filtros de Pagos
                   </a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                    <form role="form" class="form-inline" method="GET" action="<?= Url::to(['export/filter']); ?>" >
                        <div class="form-group">
                            <select class="form-control" id="ruc" name="ruc">
                                <option value="" >Seleccionar Banco</option>
                                <?php if(sizeof($listEntityBank) > 0){ ?>
                                    <?php foreach ($listEntityBank as $bank){ ?>
                                        <option value="<?= $bank->ruc; ?>" ><?= $bank->name; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" id="nrocuenta" name="nrocuenta" class="form-control" placeholder="Nro. Cuenta"/>
                        </div>
                        <div class="form-group">
                            <input type="text" id="year" name="year" class="form-control" placeholder="Año" />
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="month" name="month" >
                                <option value="" >Seleccionar Mes</option>
                                <?php if(sizeof($listMonth) > 0){ ?>
                                    <?php $value = 1; ?>
                                    <?php foreach ($listMonth as $month){ ?>
                                        <option value="<?= $value; ?>" ><?= $month; ?></option>
                                        <?php $value++; ?>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Buscar Pagos
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a id="btn_export" href="javascript:void(0);" class="btn btn-primary">
                    Exportar Pagos
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
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
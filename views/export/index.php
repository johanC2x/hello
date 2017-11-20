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
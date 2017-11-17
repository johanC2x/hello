<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Suppliers */

$this->title = 'Update Suppliers: ' . $model->person_id;
$this->params['breadcrumbs'][] = ['label' => 'Suppliers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->person_id, 'url' => ['view', 'person_id' => $model->person_id, 'account_number' => $model->account_number]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="suppliers-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

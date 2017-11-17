<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Suppliers */

$this->title = $model->person_id;
$this->params['breadcrumbs'][] = ['label' => 'Suppliers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="suppliers-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'person_id' => $model->person_id, 'account_number' => $model->account_number], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'person_id' => $model->person_id, 'account_number' => $model->account_number], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'person_id',
            'company_name',
            'account_number',
            'deleted',
        ],
    ]) ?>

</div>

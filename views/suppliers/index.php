<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Suppliers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="suppliers-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a('Nuevo Proveedor', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'person_id',
            'company_name',
            'account_number',
            'deleted',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

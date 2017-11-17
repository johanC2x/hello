<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Suppliers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="suppliers-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'person_id')->textInput() ?>
    <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'account_number')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'deleted')->textInput() ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

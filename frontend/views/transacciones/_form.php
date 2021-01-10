<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$get = Yii::$app->request->get();
?>

<div class="transacciones-form">

    <?php $form = ActiveForm::begin(['enableClientScript' => false,]); ?>

    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'tipo_id')->textInput(['type' => 'hidden', 'value' => $get['tipo']])->label(false) ?>
        </div>
        <div class="col-md-3">
            <div class="card p-3 m-3 text-center">
                <?php if ($model->tipo_id != 3): ?>
                    <img class='m-auto' src="/frontend/web/<?= $cliente_info['logo_url'] ?>" width='80%'>
                <?php else: ?>
                    <img class='m-auto' src="/frontend/web/images/inversion.png" width='80%'>
                <?php endif ?>
            </div>
        </div>
        <div class="col-md-6">
            <?php echo $form->field($model, 'tipo_id')->dropDownList(ArrayHelper::map(\frontend\models\TiposImportes::find()->all(), 'id', 'nombre'),['prompt'=>'Seleccionar...', 'class' => 'form-control input-r border-blue select-css', 'required' => 'required', 'disabled' => 'disabled']); ?>
            
            <?php if ($model->tipo_id == 3): ?>
                <?= $form->field($model, 'concepto')->textInput(['required' => 'required'])->label('Concepto') ?>
            <?php else: ?>
                <?= $form->field($model, 'servicio_extra_id')->dropDownList(ArrayHelper::map(\frontend\models\ServiciosExtras::find()->all(), 'id', 'nombre'),['prompt'=>'Seleccionar...', 'class' => 'form-control input-r border-blue select-css', 'required' => 'required'])->label('Concepto'); ?>
                <?= $form->field($model, 'concepto')->textInput([])->label('Comentario') ?>
            <?php endif ?>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <h4>Cuentas en el sistema</h4>
            <hr>
            </div>
        </div>
        <?php foreach ($cuentas as $c): ?>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?= $c->nombre ?></label>
                    <input type="number" name="cuenta[<?= $c->id ?>]" class="form-control cuenta" value='0'>
                </div>
            </div>
        <?php endforeach ?>
        <div class="col-md-6">
            <?= $form->field($model, 'total')->textInput(['id' => 'total', 'style' => 'background:#f9fbfd;', 'required' => 'required']) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'fecha_pago')->textInput(['type' => 'date', 'value' => date("Y-m-d"), 'required' => 'required']) ?>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <?= Html::submitButton('Registrar Importe', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

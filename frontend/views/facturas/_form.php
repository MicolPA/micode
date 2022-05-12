<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


$model->moneda = !$model->moneda ? "DOP" : $model->moneda;
$model->cotizacion = !$model->cotizacion ? 0 : $model->cotizacion;
$config = \frontend\models\Configuracion::findOne(1);
date_default_timezone_set('America/Santo_Domingo');
?>

<div class="facturas-form row">
        
        <div class="col-md-6 client_select" style="display:<?= $model->cliente_nombre ? 'none' : 'inline' ?>">
                <?php echo $form->field($model, 'cliente_id')->dropDownList(ArrayHelper::map(\frontend\models\Clientes::find()->all(), 'id', 'empresa'),['prompt'=>'Seleccionar...', 'class' => 'form-control input-r border-blue select_2 w-100', 'value' => isset($cliente_id) ? $cliente_id : $model->cliente_id, $model->cliente_nombre ? '' : 'required' => $model->cliente_nombre ? '' : 'required'])->label("Dirigida a:"); ?>
        </div>
        <div class="col-md-6 client_name" style="display:<?= !$model->cliente_nombre ? 'none' : 'inline' ?>">
                <?= $form->field($model, 'cliente_nombre')->textInput(['autocomplete' => 'off', $model->cliente_nombre ? 'required' : '' => $model->cliente_nombre ? 'required' : ''])->label("Dirigida a:") ?>
        </div>
        <div class="col-md-6">
                <?= $form->field($model, 'date')->textInput(['type' => 'date', 'required' => 'required', 'value' => $model->date ?  substr($model->date, 0, 10) : date('Y-m-d')]) ?>
        </div>

        <!-- <?//= $form->field($model, 'cliente_nombre')->textInput(['maxlength' => true]) ?> -->
        <div class="col-md-6">
                <?= $form->field($model, 'asunto')->textInput(['autocomplete' => 'off','maxlength' => true, 'required' => 'required']) ?>
        </div>
        <div class="col-md-6">
                <?= $form->field($model, 'comprobante')->textInput(['maxlength' => true]) ?>
        </div>
</div>

<div class="row">
        <div class="col-md-3">
                <?= $form->field($model, 'cotizacion')->radioList([1 =>'Cotización', 0 => 'Factura'])->label(false); ?>
        </div>
        <div class="col-md-3">
                <?= $form->field($model, 'moneda')->radioList(['RD' =>'DOP', 'USD' => 'USD'])->label(false); ?>
        </div>
        <div class="col-md-6 div_pago_checkbox">
                <?= $form->field($model, 'pagada')->checkBoxList(['1' =>'Si'])->label('Sello de pago: '); ?>
                <div class="div_fecha_pago" style="display:<?= $model->pagada ? '' : 'none' ?> ">
                        <?= $form->field($model, 'fecha_pagada')->textInput(['type' => 'date', 'value' => date('Y-m-d')])->label(false) ?>
                </div>
        </div>
        <div class="col-md-4">
                <?= $form->field($model, 'impuestos')->radioList([1 =>'Calcular impuestos', 0 => 'Sin impuestos'])->label(false); ?>
        </div>
        <div class="col-md-12">
            <div class="form-group pt-1">
                <label>Nota</label>
                <input name="Facturas[nota]" class="form-control" value="<?= $config['nota_factura'] ?>" maxlength="60">
                <span class="secondary small" style="color:#ccc;font-weight: bold;">Máximo 60 caracteres.</span>
            </div>
        </div>
</div>

<style>
        .field-facturas-pagada div{
                width: fit-content;
                display: inline-block;
        }

        .div_fecha_pago, .field-facturas-pagada{
                display: inline-block;
        }
</style>
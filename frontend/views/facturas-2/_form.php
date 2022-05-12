<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\Facturas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="facturas-form row">


        <div class="col-md-6">
                <?php echo $form->field($model, 'cliente_id')->dropDownList(ArrayHelper::map(\frontend\models\Clientes::find()->all(), 'id', 'empresa'),['prompt'=>'Seleccionar...', 'class' => 'form-control input-r border-blue select_2', 'required' => 'required', 'value' => isset($cliente_id) ? $cliente_id : $model->cliente_id]); ?>
        </div>
        <div class="col-md-6">
                <?= $form->field($model, 'date')->textInput(['type' => 'date', 'required' => 'required', 'value' => date('Y-m-d')]) ?>
        </div>


        <!-- <?//= $form->field($model, 'cliente_nombre')->textInput(['maxlength' => true]) ?> -->
        <div class="col-md-6">
                <?= $form->field($model, 'asunto')->textInput(['maxlength' => true, 'required' => 'required']) ?>
        </div>
        <div class="col-md-5 mt-4 div_pago_checkbox">
                <?= $form->field($model, 'pagada')->checkBoxList(['1' =>'Si'])->label('Sello de pago: '); ?>
                <div class="div_fecha_pago" style="display:<?= $model->pagada ? '' : 'none' ?> ">
                        <?= $form->field($model, 'fecha_pagada')->textInput(['type' => 'date'])->label(false) ?>
                </div>
        </div>
        

       
        



</div>

<div class="row">
         <div class="col-md-3">
                <?= $form->field($model, 'cotizacion')->radioList([1 =>'Cotización', 0 => 'Factura'])->label(false); ?>
        </div>
        <div class="col-md-4">
                <?= $form->field($model, 'moneda')->radioList(['RD' =>'DOP', 'USD' => 'USD'])->label(false); ?>
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
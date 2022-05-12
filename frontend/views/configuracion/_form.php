<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Configuracion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="configuracion-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'empresa')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-4">
            <div class="div-lab w-100 mt-4">
                <?= $form->field($model, 'favicon')->fileInput(['id' => 'inputfile1'])->label('<i class="fas fa-upload mr-2"></i> Favicon') ?>
            </div>
        </div>

        <div class="col-md-4">
            <div class="div-lab w-100 mt-4">
                <?= $form->field($model, 'logo_general_url')->fileInput(['id' => 'inputfile2'])->label('<i class="fas fa-upload mr-2"></i> Logo principal') ?>
            </div>
        </div>

        <div class="col-md-4 pt-3">
            <?= $form->field($model, 'logo_general_tipo')->radioList([1 => 'Horizontal', 0 => 'Vertical'])->label('Logo <a type="button" class="ml-1 text-dark" data-toggle="tooltip" data-placement="top" title="Determina la orientación que tiene el logo"><i class="fas fa-exclamation-circle fa-xs"></i></a>'); ?>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <span>Información de la factura</span>
                <hr>
            </div>
        </div>

        
        

        <div class="col-md-6">
            <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'correo')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'impuestos')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'codigo_factura')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'rnc')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'ncf')->textInput(['maxlength' => true]) ?>
        </div>

        
        <div class="col-md-2">
            <div class="form-group mt-3">
                <label>Color precio</label>
                <input name="Configuracion[color_precio_total_factura]" type="color" class="w-100 bg-white border-0 p-0" value="<?= $model->color_precio_total_factura ?>">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group mt-3">
                <label>Color pie</label>
                <input name="Configuracion[color_pie_factura]" type="color" class="w-100 bg-white border-0 p-0" value="<?= $model->color_pie_factura ?>">
            </div>
        </div>
        
        <div class="col-md-2">
            <div class="form-group mt-3">
                <label>Color texto</label>
                <input name="Configuracion[color_texto_factura]" type="color" class="w-100 bg-white border-0 p-0" value="<?= $model->color_texto_factura ?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="div-lab w-100 mt-4">
                <?= $form->field($model, 'logo_factura_url')->fileInput(['id' => 'inputfile3'])->label('<i class="fas fa-upload mr-2"></i> Logo en factura y Login') ?>
            </div>
        </div>
        <div class="col-md-3">
            <div class="div-lab w-100 mt-4">
                <?= $form->field($model, 'sello_url')->fileInput([])->label('<i class="fas fa-upload mr-2"></i> Sello/Firma') ?>
            </div>
        </div>
        <div class="col-md-3 mt-4">
            <div class="form-group pt-lg-4">
                <a href="/frontend/web/configuracion/limpiar-campo?campo=sello_url" class="btn btn-dark btn-xs btn-block"><i class="fas fa-times mr-2"></i> QUITAR SELLO</a>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group pt-1">
                <label>Texto pie</label>
                <textarea name="Configuracion[texto_pie_factura]" class="form-control" cols="30" rows="2" maxlength="110"><?= $model->texto_pie_factura ?></textarea>
                <span class="secondary small" style="color:#ccc;font-weight: bold;">Máximo 110 caracteres.</span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group pt-1">
                <label>Notas para facturas</label>
                <textarea name="Configuracion[nota_factura]" class="form-control" cols="30" rows="2" maxlength="60"><?= $model->nota_factura ?></textarea>
                <span class="secondary small" style="color:#ccc;font-weight: bold;">Máximo 60 caracteres.</span>
            </div>
        </div>


        <div class="col-md-12 text-right">
            <div class="form-group">
                <?= Html::submitButton('Guardar configuración', ['class' => 'btn btn-success pr-5 pl-5']) ?>
            </div>
        </div>

    </div>
    <?php ActiveForm::end(); ?>

</div>

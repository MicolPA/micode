<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Configuracion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="configuracion-form">

    <?php $form = ActiveForm::begin(['enableClientScript' => false], ['enctype' => 'multipart/form-data']); ?>

    <div class="card-body">
        <div class="form-group form-show-validation row">
            <div class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">
                <label>Código Factura (Prefijo)</label>
            </div>
            <div class="col-lg-6 col-md-9 col-sm-8">
                <?= $form->field($model, 'codigo_factura')->textInput(['autocomplete' => 'off', 'maxlength' => true])->label(false) ?>
            </div>
        </div>
        <div class="form-group form-show-validation row">
            <div class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">
                <label>Código Cotización (Prefijo)</label>
            </div>
            <div class="col-lg-6 col-md-9 col-sm-8">
                <?= $form->field($model, 'codigo_cotizacion')->textInput(['autocomplete' => 'off', 'maxlength' => true])->label(false) ?>
            </div>
        </div>
        <div class="form-group form-show-validation row">
            <div class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">
                <label>Impuestos (%)</label>
            </div>
            <div class="col-lg-6 col-md-9 col-sm-8">
                <?= $form->field($model, 'impuestos')->textInput(['autocomplete' => 'off', 'maxlength' => true])->label(false) ?>
            </div>
        </div>
        <div class="form-group form-show-validation row">
            <div class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">
                <label>Tasa del dólar</label>
            </div>
            <div class="col-lg-6 col-md-9 col-sm-8">
                <?= $form->field($model, 'tasa_dolar')->textInput(['autocomplete' => 'off', 'maxlength' => true])->label(false) ?>
            </div>
        </div>

        <div class="form-group form-show-validation row">
            <div class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">
                <label>Color del precio</label>
            </div>
            <div class="col-lg-6 col-md-9 col-sm-8">
                <input name="Configuracion[color_precio_total_factura]" type="color" class="w-100 p-0 form-control p-0" value="<?= $model->color_precio_total_factura ?>" style="height: 40px !important;padding: 0px !important;">
            </div>
        </div>

        <div class="form-group form-show-validation row">
            <label class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Imágenes</label>
            <div class="col-lg-6 col-md-9 col-sm-8">
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-file input-file-image">
                            <div style="height:100px">
                                <img class="img-upload-preview" width="100" src="<?= $model->logo_factura_url ? "$model->logo_factura_url" : 'http://placehold.it/200x200' ?>" alt="preview">
                            </div>
                            <?= $form->field($model, 'logo_factura_url')->fileInput(['id' => 'uploadImg', 'class' => 'form-control form-control-file'])->label(false) ?>
                            <label for="uploadImg" class="btn btn-primary btn-small text-white"><i class="fa fa-cloud-upload-alt mr-1"></i> Seleccionar Logo para factura</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-file input-file-image-2">
                            <div style="height:100px">
                                <img class="img-upload-preview" width="100" src="<?= $model->sello_url ? "$model->sello_url" : 'http://placehold.it/200x200' ?>" alt="preview">
                            </div>
                            <?= $form->field($model, 'sello_url')->fileInput(['id' => 'uploadImg1', 'class' => 'form-control form-control-file'])->label(false) ?>
                            <label for="uploadImg1" class="btn btn-primary btn-small text-white"><i class="fa fa-cloud-upload-alt mr-1"></i> Seleccionar Sello/Firma</label>

                            <div class="mt-2 mb-3">
                                <a href="/frontend/web/configuracion/limpiar-campo?campo=sello_url" class="btn btn-dark btn-small"><i class="fas fa-times mr-2"></i> QUITAR SELLO</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group form-show-validation row">
            <div class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">
                <label>Nota personalizada</label>
            </div>
            <div class="col-lg-6 col-md-9 col-sm-8">
               <textarea name="Configuracion[nota_factura]" class="form-control" cols="30" rows="2" maxlength="110"><?= $model->nota_factura ?></textarea>
                <span class="secondary small" style="color:#ccc;font-weight: bold;">Máximo 60 caracteres.</span>
            </div>
        </div>

        <div class="form-group form-show-validation row mt-4">
            <h2 class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right text-darkblue h4 font-weight-bold">Pie de factura</h2>
        </div>
        <div class="separator-solid mt-0"></div>
        <div class="form-group form-show-validation row">
            <div class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">
                <label>Texto</label>
            </div>
            <div class="col-lg-6 col-md-9 col-sm-8">
               <textarea name="Configuracion[texto_pie_factura]" class="form-control" cols="30" rows="2" maxlength="110"><?= $model->texto_pie_factura ?></textarea>
                <span class="secondary small" style="color:#ccc;font-weight: bold;">Máximo 110 caracteres.</span>
            </div>
        </div>
        <div class="form-group form-show-validation row">
            <div class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">
                <label>Color del texto</label>
            </div>
            <div class="col-lg-6 col-md-9 col-sm-8">
                <input name="Configuracion[color_texto_factura]" type="color" class="w-100 p-0 form-control p-0" value="<?= $model->color_texto_factura ?>" style="height: 40px !important;padding: 0px !important;">
            </div>
        </div>
        <div class="form-group form-show-validation row">
            <div class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">
                <label>Color de la barra</label>
            </div>
            <div class="col-lg-6 col-md-9 col-sm-8">
                <input name="Configuracion[color_pie_factura]" type="color" class="w-100 p-0 form-control p-0" value="<?= $model->color_pie_factura ?>" style="height: 40px !important;padding: 0px !important;">
            </div>
        </div>
        

        


        <div class="form-group form-show-validation row mt-4">
            <div class="col-lg-9 col-md-9 col-sm-8 text-right">
                <?= Html::submitButton('Guardar configuración', ['class' => 'btn btn-primary pr-5 pl-5 pt-1 pb-1']) ?>
            </div>
        </div>

    </div>
    <?php ActiveForm::end(); ?>

</div>

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
                <label>Empresa / Razón social</label>
            </div>
            <div class="col-lg-4 col-md-9 col-sm-8">
                <?= $form->field($model, 'empresa')->textInput(['autocomplete' => 'off', 'maxlength' => true])->label(false) ?>
            </div>
        </div>
        <div class="form-group form-show-validation row">
            <div class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">
                <label>RNC</label>
            </div>
            <div class="col-lg-4 col-md-9 col-sm-8">
                <?= $form->field($model, 'rnc')->textInput(['autocomplete' => 'off', 'maxlength' => true])->label(false) ?>
            </div>
        </div>
        <div class="form-group form-show-validation row">
            <div class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">
                <label>Teléfono/Móvil</label>
            </div>
            <div class="col-lg-4 col-md-9 col-sm-8">
                <?= $form->field($model, 'telefono')->textInput(['autocomplete' => 'off', 'maxlength' => true, 'id' => 'celular'])->label(false) ?>
            </div>
        </div>
        <div class="form-group form-show-validation row">
            <div class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">
                <label>Correo electrónico</label>
            </div>
            <div class="col-lg-4 col-md-9 col-sm-8">
                <?= $form->field($model, 'correo')->textInput(['autocomplete' => 'off', 'maxlength' => true])->label(false) ?>
            </div>
        </div>
        <div class="form-group form-show-validation row">
            <div class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">
                <label>Dirección</label>
            </div>
            <div class="col-lg-4 col-md-9 col-sm-8">
                <?= $form->field($model, 'direccion')->textInput(['autocomplete' => 'off', 'maxlength' => true])->label(false) ?>
            </div>
        </div>
        <div class="form-group form-show-validation row">
            <label class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Logo</label>
            <div class="col-lg-4 col-md-9 col-sm-8">
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-file input-file-image">
                            <img class="img-upload-preview" width="150" src="<?= $model->logo_general_url ? "$model->logo_general_url" : 'http://placehold.it/200x200' ?>" alt="preview" style="max-height: 100px;">
                                <?= $form->field($model, 'logo_general_url')->fileInput(['id' => 'uploadImg1', 'class' => 'form-control form-control-file'])->label(false) ?>
                            <label for="uploadImg1" class="btn btn-primary btn-small text-white"><i class="fa fa-cloud-upload-alt mr-1"></i> Seleccionar Logo</label>
                        </div>

                        <div class="mt-3">
                            <?= $form->field($model, 'logo_general_tipo')->radioList([1 => 'Horizontal', 0 => 'Vertical'])->label('Logo <a type="button" class="ml-1 text-dark" data-toggle="tooltip" data-placement="top" title="Determina la orientación que tiene el logo"><i class="fas fa-exclamation-circle fa-xs"></i></a>'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-file input-file-image-2">
                            <img class="img-upload-preview" width="150" src="<?= $model->favicon ? "$model->favicon" : 'http://placehold.it/200x200' ?>" alt="preview" style="max-height: 100px;">
                            <?= $form->field($model, 'favicon')->fileInput(['id' => 'uploadImg', 'class' => 'form-control form-control-file'])->label(false) ?>
                            <label for="uploadImg" class="btn btn-primary btn-small text-white"><i class="fas fa-cloud-upload-alt mr-1"></i> Seleccionar Favicon</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group form-show-validation row mt-4">
            <div class="col-lg-7 col-md-9 col-sm-8 text-right">
                <?= Html::submitButton('Guardar configuración', ['class' => 'btn btn-primary pr-5 pl-5 pt-1 pb-1']) ?>
            </div>
        </div>

    </div>
    <?php ActiveForm::end(); ?>

</div>

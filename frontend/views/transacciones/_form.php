<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$get = Yii::$app->request->get();
date_default_timezone_set('America/Santo_Domingo');
?>

<div class="transacciones-form">

    <?php $form = ActiveForm::begin(['enableClientScript' => false,]); ?>

    <div class="card-body">

        <div class="form-group form-show-validation row">
            <div class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">
                <label>Tipo importe <span class="required-label">*</span></label>
            </div>
            <div class="col-lg-4 col-md-9 col-sm-8">
                <?php echo $form->field($model, 'tipo_id')->dropDownList(ArrayHelper::map(\frontend\models\TiposImportes::find()->all(), 'id', 'nombre'),['prompt'=>'Seleccionar...', 'class' => 'form-control input-r border-blue select-css', 'required' => 'required'])->label(false); ?>
            </div>
        </div>
        <div class="form-group form-show-validation row">
            <div class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">
                <label>Cliente</label>
            </div>
            <div class="col-lg-4 col-md-9 col-sm-8">
                <?php echo $form->field($model, 'cliente_id')->dropDownList(ArrayHelper::map(\frontend\models\Clientes::find()->all(), 'id', 'empresa'),['prompt'=>'Seleccionar...', 'class' => 'form-control input-r border-blue select-css select_2'])->label(false); ?>
            </div>
        </div>
        <div class="form-group form-show-validation row">
            <div class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">
                <label>Tipo</label>
            </div>
            <div class="col-lg-4 col-md-9 col-sm-8">
                <?= $form->field($model, 'servicio_extra_id')->dropDownList(ArrayHelper::map(\frontend\models\ServiciosExtras::find()->all(), 'id', 'nombre'),['prompt'=>'Seleccionar...', 'class' => 'form-control input-r border-blue select-css select_2', 'required' => 'required'])->label(false); ?>
            </div>
        </div>
        <div class="form-group form-show-validation row">
            <div class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">
                <label>Fecha Pago <span class="required-label">*</span></label>
            </div>
            <div class="col-lg-4 col-md-9 col-sm-8">
                <?= $form->field($model, 'fecha_pago')->textInput(['required' => 'required', 'type' => 'date'])->label(false) ?>
            </div>
        </div>
        <div class="form-group form-show-validation row">
            <div class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">
                <label>Concepto <span class="required-label">*</span></label>
            </div>
            <div class="col-lg-4 col-md-9 col-sm-8">
                <?= $form->field($model, 'concepto')->textarea(['required' => 'required'])->label(false) ?>
            </div>
        </div>
        <div class="form-group form-show-validation row">
            <?php $colaboradores = \frontend\models\Colaboradores::find()->all(); ?>
            <div class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">
                <label>Colaborador</label>
            </div>
            <div class="col-lg-4 col-md-9 col-sm-8">
                <select class='form-control select_2' name="colaborador_id" id="colaborador_select">
                    <option value="">Seleccionar...</option>
                    <?php foreach ($colaboradores as $colab): ?>
                        <option value="<?= $colab->id ?>" <?= $colaborador_id == $colab->id ? 'selected' : '' ?>><?= "$colab->nombre $colab->apellido" ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
        <!-- <input type="hidden" name="colaborador_id"> -->
        <div class="form-group form-show-validation row mt-4">
            <h2 class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right text-darkblue h4 font-weight-bold">Forma de pago <span class="required-label">*</span></h2>
        </div>
        <div class="separator-solid mt-0"></div>

            <?php foreach ($cuentas as $c): ?>
                <?php 
                    if ($model->id) {
                        $check = \frontend\models\TransaccionesDetalle::find()->where(['transaccion_id' => $model->id, 'tarjeta_id' => $c->id])->one();
                        $total = $check ? $check->total : '0';
                    }else{
                        $total = 0;
                    }
                ?>

                <div class="form-group form-show-validation row mb-2">
                    <div class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">
                        <label><?= $c->nombre ?></label>
                    </div>
                    <div class="col-lg-4 col-md-9 col-sm-8">
                        <input type="number" class="form-control cuenta" name="cuenta[<?= $c->id ?>]" value='<?= $total ?>'>
                    </div>
                </div>
            <?php endforeach ?>
            
            <div class="dolab_amount_div" style='display: <?= !$colaborador_id ? 'none' :'' ?>;'>
                <div class="form-group form-show-validation row ">
                    <div class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">
                        <label>Colaborador total</label>
                    </div>
                    <div class="col-lg-4 col-md-9 col-sm-8 ">
                        <input type="number" name='colaborador_amount' class="form-control cuenta" value='0'>
                    </div>
                </div>
            </div>
            <div class="form-group form-show-validation row">
                <div class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">
                    <label>Importe total <span class="required-label">*</span></label>
                </div>
                <div class="col-lg-4 col-md-9 col-sm-8">
                    <?= $form->field($model, 'total')->textInput(['id' => 'total', 'style' => 'background:#f9fbfd;', 'required' => 'required', 'readonly' => 'readonly'])->label(false) ?>
                </div>
            </div>

            <div class="form-group form-show-validation row mt-4">
                <div class="col-lg-7 col-md-9 col-sm-8 text-right">
                    <?= Html::submitButton('Registrar Importe', ['class' => 'btn btn-primary pr-5 pl-5 pt-1 pb-1']) ?>
                </div>
            </div>
        
        
    </div>

    <?php ActiveForm::end(); ?>

</div>

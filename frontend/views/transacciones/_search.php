<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\TransaccionesSearch */
/* @var $form yii\widgets\ActiveForm */
?>


    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

        <div class="row mb-2">
            <div class="col-md-3">
                <?php echo $form->field($model, 'cliente_id')->dropDownList(ArrayHelper::map(\frontend\models\Clientes::find()->orderBy(['empresa' => SORT_ASC])->all(), 'id', 'empresa'),['prompt'=>'Seleccionar...', 'class' => 'form-control input-r border-blue select_2']); ?>
            </div>

            <div class="col-md-3">
                <?= $form->field($model, 'servicio_extra_id')->dropDownList(ArrayHelper::map(\frontend\models\ServiciosExtras::find()->all(), 'id', 'nombre'),['prompt'=>'Seleccionar...', 'class' => 'form-control input-r border-blue select-css'])->label('Servicio'); ?>
            </div>

            <div class="col-md-3">
                <?= $form->field($model, 'concepto') ?>
            </div>

            <div class="col-md-3">
                <?= $form->field($model, 'fecha_pago')->textInput(['type' => 'month']) ?>
            </div>

            <div class="col-md-2">
                <?php echo $form->field($model, 'pagada')->dropDownList(array('1' => 'Pagado', '2' => 'Pendiente'),['prompt'=>'Seleccionar...', 'class' => 'form-control input-r border-blue select_2']); ?>
            </div>

            <div class="col-md-2">
                <?php echo $form->field($model, 'tipo_id')->dropDownList(ArrayHelper::map(\frontend\models\TiposImportes::find()->all(), 'id', 'nombre'),['prompt'=>'Seleccionar...', 'class' => 'form-control input-r border-blue select_2']); ?>
            </div>
            

            

            

            

            <?php // echo $form->field($model, 'date') ?>

            <div class="col-md-2 pt-md-4 text-right">
                <div class="form-group">
                    <?= Html::submitButton('Buscar', ['class' => 'btn btn-warning btn-block btn-xs pl-lg-5 pr-md-5']) ?>
                </div>
            </div>
        </div>

    <?php ActiveForm::end(); ?>


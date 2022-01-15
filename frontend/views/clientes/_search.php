<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\ClientesSearch */
/* @var $form yii\widgets\ActiveForm */
?>


<?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
]); ?>
    <div class="row">

        <div class="col-md-3 p-0">
            <?= $form->field($model, 'empresa') ?>
        </div>

        <div class="col-md-2 p-0">
            <?= $form->field($model, 'dominio') ?>
        </div>

        <div class="col-md-2 p-0">
            <?php echo $form->field($model, 'tipo_servicio_id')->dropDownList(ArrayHelper::map(\frontend\models\Servicios::find()->orderBy(['nombre' => SORT_ASC])->all(), 'id', 'nombre'),['prompt'=>'Seleccionar...', 'class' => 'form-control input-r border-blue select_2']); ?>
        </div>

        <div class="col-md-2 p-0">
            <?= $form->field($model, 'representante_nombre') ?>
        </div>

        <?php // echo $form->field($model, 'representante_telefono') ?>

        <?php // echo $form->field($model, 'representante_correo') ?>

        <?php // echo $form->field($model, 'tipo_servicio_id') ?>

        <?php // echo $form->field($model, 'importe_base') ?>

        <?php // echo $form->field($model, 'fecha_comienzo') ?>

        <?php // echo $form->field($model, 'tiempo_estimado') ?>

        <?php // echo $form->field($model, 'status') ?>

        <?php // echo $form->field($model, 'date') ?>

        <div class="col-md-2 pt-lg-3 pt-md-3 pr-0 pl-0">
            <div class="form-group pt-lg-4 pt-md-4">
                <?= Html::submitButton('Buscar', ['class' => 'btn btn-warning btn-block btn-xs']) ?>
            </div>
        </div>

    </div>
<?php ActiveForm::end(); ?>


<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ConfiguracionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="configuracion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'empresa') ?>

    <?= $form->field($model, 'favicon') ?>

    <?= $form->field($model, 'logo_general_url') ?>

    <?= $form->field($model, 'logo_factura_url') ?>

    <?php // echo $form->field($model, 'color_pie_factura') ?>

    <?php // echo $form->field($model, 'color_precio_total_factura') ?>

    <?php // echo $form->field($model, 'texto_pie_factura') ?>

    <?php // echo $form->field($model, 'direccion') ?>

    <?php // echo $form->field($model, 'telefono') ?>

    <?php // echo $form->field($model, 'impuestos') ?>

    <?php // echo $form->field($model, 'rnc') ?>

    <?php // echo $form->field($model, 'nfc') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

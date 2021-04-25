<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\Facturas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="facturas-form">


        <?php echo $form->field($model, 'cliente_id')->dropDownList(ArrayHelper::map(\frontend\models\Clientes::find()->all(), 'id', 'empresa'),['prompt'=>'Seleccionar...', 'class' => 'form-control input-r border-blue select_2', 'required' => 'required', 'value' => isset($cliente_id) ? $cliente_id : $model->cliente_id]); ?>

        <!-- <?//= $form->field($model, 'cliente_nombre')->textInput(['maxlength' => true]) ?> -->
        <?= $form->field($model, 'asunto')->textInput(['maxlength' => true, 'required' => 'required']) ?>

        <?= $form->field($model, 'cotizacion')->radioList([1 =>'Cotización', 0 => 'Factura'])->label(false); ?>


</div>

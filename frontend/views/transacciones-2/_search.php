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

        <div class="row">
            <div class="col-md-2">
                <?php echo $form->field($model, 'cliente_id')->dropDownList(ArrayHelper::map(\frontend\models\Clientes::find()->orderBy(['empresa' => SORT_ASC])->all(), 'id', 'empresa'),['prompt'=>'Seleccionar...', 'class' => 'form-control input-r border-blue select_2']); ?>
            </div>

            <div class="col-md-2">
                <?php echo $form->field($model, 'tipo_id')->dropDownList(array('1' => 'Ingresos', '2' => 'Gastos'),['prompt'=>'Seleccionar...', 'class' => 'form-control input-r border-blue select_2']); ?>
            </div>

            <div class="col-md-2">
                <?= $form->field($model, 'fecha_pago')->textInput(['type' => 'month']) ?>
            </div>

            <?php // echo $form->field($model, 'date') ?>

            <div class="col-md-2 pt-lg-3 pt-md-3 pr-0 pl-0">
                <div class="form-group pt-lg-4 pt-md-4">
                    <?= Html::submitButton('Buscar', ['class' => 'btn btn-warning btn-block btn-xs']) ?>
                </div>
            </div>
        </div>

    <?php ActiveForm::end(); ?>


<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

?>


<?php $form = ActiveForm::begin([
        'method' => 'get',
        'action' => \yii\helpers\Url::to(['index', 'type' => $type])
    ]); ?>
    <div class="facturas-search row">

        <div class="col-md-2">
            <?= $form->field($model, 'asunto') ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'cliente_nombre') ?>
        </div>

        <div class="col-md-3">
            <?php echo $form->field($model, 'cliente_id')->dropDownList(ArrayHelper::map(\frontend\models\Clientes::find()->orderBy(['empresa' => SORT_ASC])->all(), 'id', 'empresa'),['prompt'=>'Seleccionar...', 'class' => 'form-control input-r border-blue select_2']); ?>
        </div>

        <?php if ($type != 1): ?>
            <div class="col-md-2">
                <?php echo $form->field($model, 'status_id')->dropDownList(ArrayHelper::map(\frontend\models\FacturasStatus::find()->all(), 'id', 'nombre'),['prompt'=>'Seleccionar...', 'class' => 'form-control input-r border-blue select_2']); ?>
            </div>
        <?php endif ?>

        <?php // echo $form->field($model, 'date') ?>

        <div class="col-md-2 pt-lg-4 pt-md-4 text-right">
            <div class="form-group">
                <?= Html::submitButton('Buscar', ['class' => 'btn btn-warning btn-block btn-xs pl-lg-5 pr-md-5']) ?>
            </div>
        </div>
    </div>

<?php ActiveForm::end(); ?>


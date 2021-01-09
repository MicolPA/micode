<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

?>

<?php $form = ActiveForm::begin(['enableClientScript' => false], ['enctype' => 'multipart/form-data']); ?>
    <div class="row">

        <div class="col-md-6">
            <?= $form->field($model, 'empresa')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-6">
        <?= $form->field($model, 'dominio')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-6 pt-3">
            <?php if ($model): ?>
                <?= $form->field($model, 'logo_url')->fileInput(['id' => 'inputfile']) ?>
            <?php else: ?>
                <?= $form->field($model, 'logo_url')->fileInput(['required' => 'required', 'id' => 'inputfile']) ?>
            <?php endif ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'representante_nombre')->textInput(['maxlength' => true]) ?>
        </div>


        <div class="col-md-6">
            <?= $form->field($model, 'representante_telefono')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'representante_correo')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?php echo $form->field($model, 'tipo_servicio_id')->dropDownList(ArrayHelper::map(\frontend\models\Servicios::find()->all(), 'id', 'nombre'),['prompt'=>'Seleccionar...', 'class' => 'form-control input-r border-blue select_2',]); ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'importe_base')->textInput() ?>
        </div>

        <div class="col-md-2 pt-4">
            <br>
            <?= $form->field($model, 'pago_mensual')->label('TIPO')->radioList([1=>'Único', 2 => 'Mensual'])->label(false); ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'fecha_comienzo')->textInput(['type' => 'date']) ?>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Tiempo Estimado</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="Clientes[tiempo_estimado]" aria-label="Recipient's username" aria-describedby="basic-addon2" value="<?= $model->tiempo_estimado ?>">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">Semanas</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <?php echo $form->field($model, 'status')->dropDownList(ArrayHelper::map(\frontend\models\ClientesEstatus::find()->orderBy(['nombre'=>SORT_ASC])->all(), 'id', 'nombre'),['prompt'=>'Seleccionar...', 'class' => 'form-control input-r border-blue select_2',]); ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'fecha_finalizacion')->textInput(['type' => 'date']) ?>
        </div>

        <div class="col-md-12 text-right pt-4 pb-4">
            <div class="form-group">
                <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary pr-5 pl-5']) ?>
            </div>
        </div>

    </div>
<?php ActiveForm::end(); ?>

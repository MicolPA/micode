<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use asmoday74\ckeditor5\EditorClassic;

?>
<style>
    .ck-editor__editable_inline {
        min-height: 250px;
        max-height: 250px;
    }
    .form-check, .form-group{
        padding: 0px;
    }
</style>
<div class="anotaciones-form">

    <?php $form = ActiveForm::begin(['id' => 'form', 'action' => '/frontend/web/anotaciones/ver', 'method' => 'POST']); ?>


    <?= $form->field($model, 'text')->widget(EditorClassic::className(),[
        'clientOptions' => [
            'language' => 'es',
            'uploadUrl' => 'upload',    //url for upload files
            'uploadField' => 'image',   //field name in the upload form
        ],
        'options' => [
            'row' => 6,
            'style' => 'height: 250px;',
            'width' => '100%',
            'height' => '250px',
       ],
    ])->label(false); ?>

    <input type="hidden" name="cliente_id" value="<?= $model->cliente_id ?>">
    <input type="hidden" name="user_id" value="<?= $model->user_id ?>">

   <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary btn-sm mt-3 float-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
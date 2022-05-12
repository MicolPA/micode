<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use asmoday74\ckeditor5\EditorClassic;


$this->title = 'Enviar Email';
$this->params['breadcrumbs'][] = $this->title;


if (isset($model->factura->cliente->representante_nombre)){
    if ($model->factura->cliente->representante_nombre) {
        $nombre_cliente = $model->factura->cliente->representante_nombre .  " (" .$model->factura->cliente->empresa . ")";
    }else{
        $nombre_cliente = $model->factura->cliente->empresa;
    }
    $model->email = $model->factura->cliente->representante_correo;
}else{
    $nombre_cliente = $model->factura->cliente_nombre;
}
?>

<style>
    .ck-editor__editable_inline {
        min-height: 200px;
        max-height: 200px;
    }
    .form-check, .form-group{
        padding: 0px;
    }


</style>
<div class="main-panel">

    <div class="content">
        <div class="page-inner">
            
            <div class="page-header">
                <?php  
                    echo $this->render('/layouts/breadcrumb', 
                    ['modulo' => "Facturas", 'modulo_url' => "/frontend/web/facturas", 'pagina' => 'Enviar email']); 
                ?>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <?php $form = ActiveForm::begin(['id' => 'form', 'method' => 'POST']); ?>
                    <div class="row mt-3">
                        <div class="col-md-12 mt-2">
                            <?= $form->field($model, 'asunto')->textInput([]) ?>
                        </div>
                        <div class="col-md-12 mt-2">
                            <?= $form->field($model, 'email')->textInput([]) ?>
                        </div>
                        <div class="col-md-12 mt-3">
                            <?= $form->field($model, 'mensaje')->widget(EditorClassic::className(),[
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
                        </div>


                        <div class="col-md-12 pt-4 pb-4">
                            <div class="form-group">
                                <?= Html::submitButton('Registrar', ['class' => 'btn btn-primary pr-5 pl-5 btn-block font-weight-bold', 'formtarget' => '_blank', 'id' => 'submitButton']) ?>
                            </div>
                        </div>
                    </div>



                    <?php ActiveForm::end(); ?>
                </div>
                <!-- <div class="col-md-4">
                    <div class="bg-warning" style="height:500px">
                        
                    </div>
                </div> -->
            </div>
        </div>
        
    </div>


</div>

<script>
    setTimeout(function(){
        $('#editor').summernote({
            // fontNaes: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New'],
            tabsize: 2,
            height: 300,
            toolbar: [
            [ 'style', [ 'style' ] ],
            [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough'] ],
            [ 'fontname', [ 'fontname' ] ],
            [ 'fontsize', [ 'fontsize' ] ],
            [ 'color', [ 'color' ] ],
            [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
            [ 'table', [ 'table' ] ],
            [ 'insert', [ 'link'] ],
            [ 'view', [ 'undo', 'redo', 'codeview', 'help' ] ]
        ]
        });
    },500)
</script>
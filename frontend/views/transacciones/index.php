<?php

use yii\helpers\Html;
use yii\grid\GridView;

$name2 = ucfirst($name);
$this->title = $name2;
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="main-panel">

    <div class="content">
        <div class="page-inner">
            <div class="page-header mb-0">
                <?php  
                    echo $this->render('/layouts/breadcrumb', 
                    ['modulo' => "Finanzas", 'modulo_url' => "/frontend/web/transacciones", 'pagina' => "Historial de $name"]); 
                ?>
                <div class="ml-md-auto py-2 py-md-0">
                    <!-- <button type="button" class="btn btn-success btn-xs pr-4 pl-4" data-toggle="modal" data-target="#registrarImporteModal"><i class="fas fa-plus-circle mr-2"></i> Registrar Importe</button> -->
                    <a href="/frontend/web/transacciones/registrar?view=/transacciones" class="btn btn-success btn-xs pr-4 pl-4" ><i class="fas fa-plus-circle mr-2"></i> Registrar Importe</a>
                </div>
            </div>
            <?= $this->render('_search', ['model' => $searchModel]) ?>

            <div class="row">
                <div class="col-md-12">
                    <?= $this->render('_transacciones', [
                        'model' => $model,
                        'name' => "Historial de $name2",
                        'pagination' => $pagination,
                    ]) ?>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    setTimeout(function() {
        //displayNotification('Correcto','Mostrando transacciones','fas fa-check-circle');
    }, 1000);
</script>
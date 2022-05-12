<?php

use yii\helpers\Html;

$this->title = $name;
$this->params['breadcrumbs'][] = ['label' => 'Configuracions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-panel">

    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <?php  
                    echo $this->render('/layouts/breadcrumb', 
                    ['modulo' => "Configuración del sistema", 'modulo_url' => "/frontend/web/configuracion", 'pagina' => 'Variables globales']); 
                ?>
                
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card pt-2">
                        <div class="card-header">
                            <div class="card-title"><?= Html::encode($this->title) ?></div>
                        </div>
                        <?= $this->render($template, [
                            'model' => $model,
                        ]) ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

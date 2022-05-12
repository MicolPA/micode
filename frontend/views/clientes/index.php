<?php

use yii\helpers\Html;
use yii\grid\GridView;

$total = $dataProvider->query->count();

$this->title = 'Clientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-panel">

    <div class="content">
        <div class="page-inner">
            
            <div class="page-header">
                <?php  
                    echo $this->render('/layouts/breadcrumb', 
                    ['modulo' => "Clientes", 'modulo_url' => "/frontend/web/clientes", 'pagina' => 'Listado de clientes']); 
                ?>
                <div class="ml-md-auto py-2 py-md-0">
                    <?= Html::a('<i class="fas fa-plus-circle mr-2"></i> Registrar cliente', ['registrar'], ['class' => 'btn btn-success btn-xs pr-4 pl-4']) ?>
                </div>
            </div>
            <?= $this->render('_search', ['model' => $searchModel]) ?>
            <div>
                <p class="mb-0 small"><?= $total == 1 ? "$total registro." : "$total registros." ?></p>
            </div>
            <div class="table-responsive bg-white shadow-sm" id="theDatatable">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'summary' => '',
                    'tableOptions' => [
                        'class'=>'table'
                    ],
                    // 'tableOptions' => ['class' => 'table'],
                    'layout' => "{summary}\n{items}\n<div class='text-center grid-page pg-primary'>{pager}</div>",
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        // 'id',
                        [
                            'attribute' => 'empresa',
                            'format' => 'raw',
                            'value' => function ($data) {
                                $view =  Html::a($data->empresa, ['perfil', 'id' => $data->id], []);
                                return "$view";
                            },
                        ], 
                        [
                            'format' => 'raw',
                            'attribute' => 'dominio',
                            'value' => function($data){
                                $btn = "<a href='https://$data->dominio' target='_blank'>$data->dominio</a>";
                                return $btn;
                            }
                        ],
                        // [
                        //     'label' => 'Tipo servicio',
                        //     'attribute' => 'tipoServicio.nombre',
                        // ],
                        [
                            'label' => 'Representante',
                            'attribute' => 'representante_nombre',
                        ],
                        [
                            'label' => '',
                            'format' => 'raw',
                            'value' => function($data){
                                $url = '"/clientes/perfil?id='. $data->id .'"';
                                $btn = "<a href='javascript:addImporte($data->id, $url)' class='badge bg-primary text-white btn-round btn-sm'>Registrar Importe</a>";

                                return $btn;
                            }
                        ],
                       
                        // 'representante_telefono',
                        //'representante_correo',
                        //'importe_base',
                        //'fecha_comienzo',
                        //'tiempo_estimado',
                        //'status',
                        //'date',
                        [
                            'label' => '',
                            'format' => 'raw',
                            'options' => ['class' => 'col-md-2 col-xs-4 col-sm-4'],
                            'value' => function ($data) {
                                $view =  Html::a('<i class="fas fa-eye text-white btn-primary btn btn-small"></i>', ['perfil', 'id' => $data->id], []);
                                
                                $delete = Html::a('<i class="fas fa-trash text-white btn-danger btn btn-small"></i>', ['delete', 'id' => $data->id], [
                                    'data' => [
                                        'confirm' => '¿Está seguro/a que desea eliminar este registro?',
                                        'method' => 'post',
                                    ],
                                ]);
                                if (Yii::$app->user->identity->role_id == 1) {
                                    $update =  Html::a('<i class="fas fa-pencil-alt text-white btn-primary btn btn-small"></i>', ['editar', 'id' => $data->id], []);
                                    return "$view $update $delete";
                                }else{
                                    $update =  Html::a('<i class="fas fa-pencil-alt text-white btn-warning btn btn-small"></i>', ['editar', 'id' => $data->id], []);
                                    return "$view $update";
                                }
                            },
                        ],  

                        // ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
        </div>
        </div>

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        
        
    </div>


</div>



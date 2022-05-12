<?php

use yii\helpers\Html;
use yii\grid\GridView;

$total = $dataProvider->query->count();

$type = isset(Yii::$app->request->get()['type']) ? Yii::$app->request->get()['type'] : 0;

if ($type == 1) {
    $type_name = "Cotizaciones";
}else{
    $type_name = "Facturas";
}

$this->title = $type_name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-panel">

    <div class="content">
        <div class="page-inner">
            <div class="page-header mb-0">
                <?php  
                    echo $this->render('/layouts/breadcrumb', 
                    ['modulo' => "$type_name", 'modulo_url' => "/frontend/web/facturas?type=$type", 'pagina' => "Listado de $type_name"]); 
                ?>
                <div class="ml-md-auto py-2 py-md-0">
                    <!-- <?//= Html::a('<i class="fas fa-plus-circle mr-2"></i> Crear', ['registrar', 'type' => $type], ['class' => 'btn btn-primary btn-xs']) ?> -->
                    <?php if ($type == 1): ?>
                        <?= Html::a('<i class="fas fa-plus-circle mr-2"></i> Registrar nueva cotización', ['registrar', 'type' => $type], ['class' => 'btn btn-success btn-xs']) ?>
                    <?php else: ?>
                        <?= Html::a('<i class="fas fa-plus-circle mr-2"></i> Registrar nueva factura', ['registrar', 'type' => $type], ['class' => 'btn btn-success btn-xs']) ?>
                    <?php endif ?>
                </div>
            </div>
            <?= $this->render('_search', ['model' => $searchModel, 'type' => $type]) ?>
            <div>
                <p class="mb-0 small"><?= $total == 1 ? "$total registro." : "$total registros." ?></p>
            </div>
            <div class="table-responsive bg-white shadow-sm pb-3" id="theDatatable">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    // 'filterModel' => $searchModel,
                    'summary' => '',
                    'tableOptions' => [
                        'class'=>'table',
                    ],

                    'layout' => "{summary}\n{items}\n<div class='text-center grid-page pg-primary'>{pager}</div>",
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        // 'id',
                        [
                            'options' => ['class' => 'col-md-3 col-xs-3 col-sm-3'],
                            'label' => 'Dirigida a:',
                            'attribute' => 'cliente_id',
                            'format' => 'raw',
                            'value' => function ($data) {
                                if (isset($data->cliente->empresa)) {
                                    $name = $data->cliente->empresa;
                                }else{
                                    $name = $data->cliente_nombre;
                                }
                                if (strlen($name) > 16) {
                                    $sub = substr($name, 0, 15);
                                    $name = "<span data-toggle='tooltip' data-placement='top' title='$name'>$sub...</span>";
                                }
                                
                                return Html::a("#".$data->factura_code . ' - ' . $name, ['ver', 'id' => $data->id], ['target' => '_blank', 'class' => 'font-weight-bold']);
                            },
                        ],
                        [
                            'options' => ['class' => 'col-md-2 col-xs-2 col-sm-2'],
                            'format' => 'raw',
                            'attribute' => 'asunto',
                            'value' => function ($data) {
                                
                                if (strlen($data->asunto) > 14) {
                                    $sub = substr($data->asunto, 0, 16);
                                    $data->asunto = "<span data-toggle='tooltip' data-placement='top' title='$data->asunto'>$sub...</span>";
                                }
                                
                                return $data->asunto;
                            },
                        ],
                        
                        // [
                        //     'label' => 'Tipo',
                        //     'attribute' => 'cotizacion',
                        //     'value' => function($data){
                        //         return $data->cotizacion == 1 ? "Cotización" : "Factura";
                        //     }
                        // ],
                       
                        [
                            'visible' => $type == 1? false : true,
                            'label' => 'Estado',
                            'format' => 'raw',
                            'attribute' => 'pagada',
                            'value' => function($data){

                                if (isset($data->facturaStatus->nombre)) {
                                    $name = $data->facturaStatus->nombre;
                                    $color = $data->facturaStatus->color;
                                }else{
                                    $name = "Pendiente";
                                    $color = "warning";
                                }

                                return "<b class='text-$color font-weight-bold'><a href='javascript:cambiarFacturaStatus($data->id)'>$name</b></a>";

                                // if ($data->pagada) {

                                //     return "<b class='text-primary'>Pagada</b>";
                                // }else{
                                //     $action = Html::a("<b class='text-warning font-weight-bold'>Pendiente</b>", ['mark-as-paid', 'id' => $data->id], [
                                //         'data' => [
                                //             'confirm' => '¿Está seguro/a que desea marcar la factura como pagada?',
                                //             'method' => 'post',
                                //         ],
                                //     ]);

                                //     return $action;
                                // }
                            }
                        ],

                        [
                            'label' => 'Fecha',
                            'attribute' => 'date',
                            'value' => function ($data) {
                                return date('d/m/Y', strtotime(str_replace('-','/', $data->date)));
                            },
                        ],
                        [
                            'label' => 'Registrada por',
                            'options' => ['class' => 'col-md-2 col-xs-2 col-sm-2'],
                            'attribute' => 'user_id',
                            'format' => 'raw',
                            'value' => function ($data) {
                                $user = \frontend\models\User::findOne($data->user_id);
                                if ($user) {
                                    return "$user->first_name $user->last_name";
                                }else{
                                    return '';
                                }
                            },
                        ], 

                        [
                            'visible' => $type != 1? false : true,
                            'label' => 'Estado',
                            'format' => 'raw',
                            'attribute' => 'pagada',
                            'value' => function($data){
                                return Html::a("Generar factura", ['convertir-factura', 'id' => $data->id], ['class' => 'btn btn-warning btn-small font-weight-bold']);
                            }
                        ],

                        
                        [
                            'label' => '',
                            'format' => 'raw',
                            'options' => ['class' => 'col-md-2 col-xs-4 col-sm-4'],
                            'value' => function ($data) {
                                $email =  Html::a('<span class="font-14 text-primary mr-0"><i class="fas fa-envelope font-14 text-primary mr-1"></i> </span>', ['enviar-email', 'id' => $data->id], []);
                                $view =  Html::a('<i class="fas fa-eye font-14 text-primary mr-0"></i>', ['ver', 'id' => $data->id], ['target' => '_blank']);
                                $update =  Html::a('<i class="fas fa-pencil-alt font-14 text-primary mr-0 small"></i>', ['editar', 'id' => $data->id, 'w_client' => $data->cliente_id ? 1 : 0], []);
                                $delete = Html::a('<i class="fas fa-trash font-14 text-danger small"></i>', ['delete', 'id' => $data->id], [
                                    'data' => [
                                        'confirm' => '¿Está seguro/a que desea eliminar este registro?',
                                        'method' => 'post',
                                    ],
                                ]);
                                if (Yii::$app->user->identity->role_id != 2) {
                                    $update =  Html::a('<i class="fas fa-pencil-alt font-14 text-primary mr-0 small"></i>', ['editar', 'id' => $data->id, 'w_client' => $data->cliente_id ? 1 : 0], []);
                                    return "$view $update $delete";
                                }else{
                                    $update =  Html::a('<i class="fas fa-pencil-alt font-14 text-warning mr-0 small"></i>', ['editar', 'id' => $data->id, 'w_client' => $data->cliente_id ? 1 : 0], []);
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

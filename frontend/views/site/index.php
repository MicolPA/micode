<?php
    $this->title = 'Inicio';
?>

<div class="main-panel">
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Dashboard</h2>
                        <h5 class="text-white op-7 mb-2">Sistema de Gestión de MiCode</h5>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                        <a href="/frontend/web/transacciones" class="btn btn-white btn-border btn-round mr-2">Finanzas</a>
                        <a href="/frontend/web/clientes/registrar" class="btn btn-secondary btn-round">Agregar Cliente</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <div class="row mt--2">
                <div class="col-md-6">
                    <div class="card full-height">
                        <div class="card-body">
                            <div class="card-title">Estadística Generales</div>
                            <div class="card-category">Estadística de los últimos 30 días</div>
                            <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                                <div class="px-2 pb-2 pb-md-0 text-center">
                                    <div id="circles-1"></div>
                                    <h6 class="fw-bold mt-3 mb-0">Clientes</h6>
                                </div>
                                <div class="px-2 pb-2 pb-md-0 text-center">
                                    <div id="circles-2"></div>
                                    <h6 class="fw-bold mt-3 mb-0">Ingresos</h6>
                                </div>
                                <div class="px-2 pb-2 pb-md-0 text-center">
                                    <div id="circles-3"></div>
                                    <h6 class="fw-bold mt-3 mb-0">Texto</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card full-height">
                        <div class="card-body">
                            <div class="card-title">Ingresos totales & Gastos</div>
                            <div class="row py-3">
                                <div class="col-md-4 d-flex flex-column justify-content-around">
                                    <div>
                                        <h6 class="fw-bold text-uppercase text-success op-8">Ingresos totales</h6>
                                        <h3 class="fw-bold">$9.782</h3>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold text-uppercase text-danger op-8">Gastos</h6>
                                        <h3 class="fw-bold">$1,248</h3>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div id="chart-container">
                                        <canvas id="totalIncomeChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-primary card-round">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="flaticon-users"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Visitors</p>
                                        <h4 class="card-title">1,294</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-danger card-round">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="flaticon-analytics"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Sales</p>
                                        <h4 class="card-title">$ 1,345</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-secondary card-round">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="flaticon-success"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Order</p>
                                        <h4 class="card-title">576</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-info card-round">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="flaticon-users"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Visitors</p>
                                        <h4 class="card-title">1,294</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        
                        <div class="card-body">
                            <?php $clientes_2 = \frontend\models\Clientes::find()->where(['<>', 'status',  3])->all(); ?>
                            <?= $this->render('/servicios/_calendario', [
                                'clientes' => $clientes_2
                            ]) ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="card-title">Servicios</div>
                        </div>
                        <div class="card-body pb-0">
                            <?php foreach ($servicios as $serv): ?>
                                <?php $count = \frontend\models\Clientes::find()->where(['tipo_servicio_id' => $serv->id])->count(); ?>
                                <div class="d-flex">
                                    <div class="avatar">
                                        <i class="fas fa-laptop fa-lg"></i>
                                    </div>
                                    <div class="flex-1 pt-1 ml-2">
                                        <p class="text-white font-weight-bold h5"><?= $serv->nombre ?></p>
                                    </div>
                                    <div class="d-flex ml-auto align-items-center">
                                        <h3 class="text-white fw-bold">+<?= number_format($count) ?></h3>
                                    </div>
                                </div>
                                <div class="separator-dashed"></div>
                            <?php endforeach ?>
                            
                        </div>
                    </div>
                </div>
            </div>
            
           
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Últimas transacciones</div>
                        </div>
                        <div class="card-body">
                            <ol class="activity-feed">
                                <?php foreach ($transacciones as $pago): ?>
                                    <?php $class = $pago->tipo_id == 1 ? "success" : 'danger' ?>
                                    <li class="feed-item feed-item-<?= $class ?>">
                                        <div class="col-md-12">
                                            <time class="date" datetime="9-24"><?= $pago->fecha_pago ?></time>
                                            <?php 

                                                if ($pago->tipo_id == 3) {
                                                    $text = "<span class='font-weight-bold'>".$pago->tipo->nombre.":</span>";
                                                    $text2 = $pago->concepto;
                                                }else{
                                                    $text = "<span class='font-weight-bold'>". $pago->cliente->empresa . "</span>: " . $pago->tipo->nombre;
                                                    $text2 = $pago->servicioExtra->nombre;
                                                }

                                             ?>
                                            <span class="text"><?= $text ?> por concepto de <a href="/frontend/web/transacciones/editar?id=<?= $pago->id ?>&view=/transacciones&tipo=<?= $pago->tipo_id ?>&cliente=<?= $pago->cliente_id ?>"><?= $text2 ?></a> <span class="float-right badge-pill badge-<?= $class ?>">RD$<?= number_format($pago->total) ?></span> </span>
                                        </div>
                                    </li>   
                                <?php endforeach ?>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

<?= $this->render('_index_chart', ['clientes' => $clientes]) ?>


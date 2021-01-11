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
                        <h5 class="text-white op-7 mb-2">Sistema de Gestión de MicodeRD</h5>
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
                            <div class="card card-stats card-info card-round">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <i class="flaticon-interface-6"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 col-stats">
                                            <div class="numbers">
                                                <p class="card-category">Subscribers</p>
                                                <h4 class="card-title">1303</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-success card-round">
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
                            <div class="d-flex">
                                <div class="avatar">
                                    <img src="/frontend/web/images/logoproduct.svg" alt="..." class="avatar-img rounded-circle">
                                </div>
                                <div class="flex-1 pt-1 ml-2">
                                    <h6 class="fw-bold mb-1">CSS</h6>
                                    <small class="text-white font-weight-bold">Cascading Style Sheets</small>
                                </div>
                                <div class="d-flex ml-auto align-items-center">
                                    <h3 class="text-info fw-bold">+$17</h3>
                                </div>
                            </div>
                            <div class="separator-dashed"></div>
                            <div class="d-flex">
                                <div class="avatar">
                                    <img src="/frontend/web/images/logoproduct.svg" alt="..." class="avatar-img rounded-circle">
                                </div>
                                <div class="flex-1 pt-1 ml-2">
                                    <h6 class="fw-bold mb-1">J.CO Donuts</h6>
                                    <small class="text-white font-weight-bold">The Best Donuts</small>
                                </div>
                                <div class="d-flex ml-auto align-items-center">
                                    <h3 class="text-info fw-bold">+$300</h3>
                                </div>
                            </div>
                            <div class="separator-dashed"></div>
                            <div class="d-flex">
                                <div class="avatar">
                                    <img src="/frontend/web/images/logoproduct3.svg" alt="..." class="avatar-img rounded-circle">
                                </div>
                                <div class="flex-1 pt-1 ml-2">
                                    <h6 class="fw-bold mb-1">Ready Pro</h6>
                                    <small class="text-white font-weight-bold">Bootstrap 4 Admin Dashboard</small>
                                </div>
                                <div class="d-flex ml-auto align-items-center">
                                    <h3 class="text-info fw-bold">+$350</h3>
                                </div>
                            </div>
                            <div class="separator-dashed"></div>
                            <div class="d-flex">
                                <div class="avatar">
                                    <img src="/frontend/web/images/logoproduct3.svg" alt="..." class="avatar-img rounded-circle">
                                </div>
                                <div class="flex-1 pt-1 ml-2">
                                    <h6 class="fw-bold mb-1">Ready Pro</h6>
                                    <small class="text-white font-weight-bold">Bootstrap 4 Admin Dashboard</small>
                                </div>
                                <div class="d-flex ml-auto align-items-center">
                                    <h3 class="text-info fw-bold">+$350</h3>
                                </div>
                            </div>
                            <div class="separator-dashed"></div>
                            <div class="d-flex">
                                <div class="avatar">
                                    <img src="/frontend/web/images/logoproduct3.svg" alt="..." class="avatar-img rounded-circle">
                                </div>
                                <div class="flex-1 pt-1 ml-2">
                                    <h6 class="fw-bold mb-1">Ready Pro</h6>
                                    <small class="text-white font-weight-bold">Bootstrap 4 Admin Dashboard</small>
                                </div>
                                <div class="d-flex ml-auto align-items-center">
                                    <h3 class="text-info fw-bold">+$350</h3>
                                </div>
                            </div>
                            <div class="separator-dashed"></div>
                            <div class="d-flex">
                                <div class="avatar">
                                    <img src="/frontend/web/images/logoproduct3.svg" alt="..." class="avatar-img rounded-circle">
                                </div>
                                <div class="flex-1 pt-1 ml-2">
                                    <h6 class="fw-bold mb-1">Ready Pro</h6>
                                    <small class="text-white font-weight-bold">Bootstrap 4 Admin Dashboard</small>
                                </div>
                                <div class="d-flex ml-auto align-items-center">
                                    <h3 class="text-info fw-bold">+$350</h3>
                                </div>
                            </div>
                            <div class="separator-dashed"></div>
                            
                        </div>
                    </div>
                </div>
            </div>
            
           
            <div class="row">
                <div class="col-md-12">
                    <div class="card full-height">
                        <div class="card-header">
                            <div class="card-title">Feed Activity</div>
                        </div>
                        <div class="card-body">
                            <ol class="activity-feed">
                                <li class="feed-item feed-item-secondary">
                                    <time class="date" datetime="9-25">Sep 25</time>
                                    <span class="text">Responded to need <a href="#">"Volunteer opportunity"</a></span>
                                </li>
                                <li class="feed-item feed-item-success">
                                    <time class="date" datetime="9-24">Sep 24</time>
                                    <span class="text">Added an interest <a href="#">"Volunteer Activities"</a></span>
                                </li>
                                <li class="feed-item feed-item-info">
                                    <time class="date" datetime="9-23">Sep 23</time>
                                    <span class="text">Joined the group <a href="single-group.php">"Boardsmanship Forum"</a></span>
                                </li>
                                <li class="feed-item feed-item-warning">
                                    <time class="date" datetime="9-21">Sep 21</time>
                                    <span class="text">Responded to need <a href="#">"In-Kind Opportunity"</a></span>
                                </li>
                                <li class="feed-item feed-item-danger">
                                    <time class="date" datetime="9-18">Sep 18</time>
                                    <span class="text">Created need <a href="#">"Volunteer Opportunity"</a></span>
                                </li>
                                <li class="feed-item">
                                    <time class="date" datetime="9-17">Sep 17</time>
                                    <span class="text">Attending the event <a href="single-event.php">"Some New Event"</a></span>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
    
</div>

<?= $this->render('_index_chart', ['clientes' => $clientes]) ?>


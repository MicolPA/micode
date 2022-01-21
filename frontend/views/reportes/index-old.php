<?php

use yii\helpers\Html;
use yii\grid\GridView;

$get = Yii::$app->request->get();

$desde = date("Y-m-d",strtotime($desde)); 
$hasta = date("Y-m-d",strtotime($hasta)); 

$data['ganancias'] = $data['ganancias'] < 1 ? 0 : $data['ganancias'];
$data['ingresos'] = $data['ingresos'] < 1 ? 0 : $data['ingresos'];

$this->title = 'Reportes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-panel">

    <div class="content">
        <div class="page-inner">
            <div class="row mb-3">
                <div class="col-md-4">
                    <h1 class="h1"><?= $this->title ?></h1>
                </div>
                <div class="col-md-8">
                    <form method="GET" class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="padding: 2px 1rem !important">Desde</span>
                                </div>
                                <input type="date" name="desde" id="" class="form-control" value="<?= $desde ?>">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="padding: 2px 1rem !important">Hasta</span>
                                </div>
                                <input type="date" class="form-control" name="hasta" aria-describedby="button-addon4" value="<?= $hasta ?>" style="padding: 2px 1rem !important">
                                <div class="input-group-append" id="button-addon4">
                                    <button class="btn btn-primary" type="submit" style="padding: 2px 1rem !important"><i class='fas fa-chevron-right'></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-6">
                    <div class="card card-stats card-info card-round">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="icon-big text-center">
                                        <i class="flaticon-graph"></i>
                                    </div>
                                </div>
                                <div class="col-8 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Ingresos</p>
                                        <h4 class="card-title"><?= number_format($data['ingresos']) ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-6 col-md-6">
                    <div class="card card-stats card-danger card-round">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-4">
                                    <div class="icon-big text-center">
                                        <i class="flaticon-error"></i>
                                    </div>
                                </div>
                                <div class="col-8 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Gastos</p>
                                        <h4 class="card-title"><?= number_format($data['gastos']) ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-6 col-md-4">
                    <div class="card card-stats card-success card-round">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-4">
                                    <div class="icon-big text-center">
                                        <i class="flaticon-success"></i>
                                    </div>
                                </div>
                                <div class="col-8 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Ganancias</p>
                                        <h4 class="card-title"><?= number_format($data['ganancias']) ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="card card-stats card-warning card-round">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-4">
                                    <div class="icon-big text-center">
                                        <i class="flaticon-users"></i>
                                    </div>
                                </div>
                                <div class="col-8 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Clientes</p>
                                        <h4 class="card-title"><?= number_format($data['clientes']) ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="card card-stats card-secondary card-round">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-4">
                                    <div class="icon-big text-center">
                                        <i class="flaticon-users"></i>
                                    </div>
                                </div>
                                <div class="col-8 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Colaboradores</p>
                                        <h4 class="card-title"><?= number_format($data['colaboradores']) ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                
                <div class="col-md-12">
                    <div class="card pt-4 pb-4">
                        <!--  <div class="card-header">
                            <div class="card-title">Importes</div>
                        </div> -->
                        <div class="card-body">
                            <div class="chart-container2">
                                <div class="row align-items-center">
                                    <div class="col-md-7">
                                        <?php  echo $this->render('_chart_importes_general', ['importes_ganancias' => $importes_ganancias,'importes' => $importes, 'meses' => $meses]); ?>
                                    </div>
                                    <div class="col-md-5">
                                        <?php echo $this->render('_chart_ganancias', ['importes' => $data]); ?>
                                    </div>
                                </div>

                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                
        </div>
        
    </div>


</div>

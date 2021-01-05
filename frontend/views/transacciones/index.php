<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ClientesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transacciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-panel">

    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Transacciones</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="#">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="/frontend/web/transacciones">Transacciones</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Historial de transacciones</a>
                    </li>
                </ul>
                <!-- <div class="ml-md-auto py-2 py-md-0">
                    <?//= Html::a('<i class="fas fa-plus-circle mr-2"></i> Nuevo', ['registrar'], ['class' => 'btn btn-secondary btn-round']) ?>
                </div> -->
            </div>

            <div class="row">
               <?php foreach ($cuentas as $c): ?>
                    <div class="col-md-4">
                        <a href="/frontend/web/tarjetas/historico?id=<?= $c->id ?>" class='no-link'>
                            <div class="card bg-<?= $c->color ?>">
                                <div class="card-body pb-0 pb-3">
                                    <div class="d-flex text-white">
                                        <div class="avatar">
                                            <i class="<?= $c->icon ?> fa-2x mt-2"></i>
                                            <!-- <img src="../assets/img/logoproduct.svg" alt="..." class="avatar-img rounded-circle"> -->
                                        </div>
                                        <div class="flex-1 pt-1 ml-2">
                                            <h6 class="fw-bold mb-1 h2"><?= $c->nombre ?></h6>
                                            <small class="h3">Saldo total</small>
                                        </div>
                                        <div class="d-flex ml-auto align-items-center">
                                            <h3 class=" fw-bold">RD$<?= number_format($c->dinero_total) ?></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
               <?php endforeach ?>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Historial de transacciones</div>
                        </div>
                        <div class="card-body">
                            <ol class="activity-feed">
                                <?php foreach ($model as $pago): ?>
                                    <?php $class = $pago->tipo_id == 2 ? "danger" : 'success' ?>
                                    <li class="feed-item feed-item-<?= $class ?>">
                                        <div class="col-md-4">
                                            <time class="date" datetime="9-24"><?= $pago->fecha_pago ?></time>
                                            <span class="text"><?= $pago->tipo->nombre ?> <a href="/frontend/web/transacciones/ver/<?= $pago->id ?>"><?= $pago->servicioExtra->nombre ?></a> <span class="float-right badge-pill badge-<?= $class ?>">RD$<?= number_format($pago->total) ?></span> </span>
                                        </div>
                                    </li>   
                                <?php endforeach ?>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        
    </div>


</div>

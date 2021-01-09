<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TarjetasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tarjetas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-panel">

    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Reportes</h4>
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
                        <a href="/frontend/web/tarjetas">Reportes</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Dashboard Reportes</a>
                    </li>
                </ul>
                
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Ingresos vs Ganancias</div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <?php echo $this->render('_chart_ganancias', ['importes' => $importes, 'importes_ganancias' => $importes_ganancias, 'meses' => $meses]); ?>
                            </div>
                        </div>
                    </div>
                </div>
            	<div class="col-md-6">
					<div class="card">
						<div class="card-header">
							<div class="card-title">Importes</div>
						</div>
						<div class="card-body">
							<div class="chart-container">
                                <?php  echo $this->render('_chart_importes_general', ['importes' => $importes, 'meses' => $meses]); ?>
							</div>
						</div>
					</div>
				</div>
                
            </div>

        </div>


        
    </div>


</div>

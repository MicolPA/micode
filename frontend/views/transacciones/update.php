<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Transacciones */

$this->title = 'Detalle de Transacción';
$this->params['breadcrumbs'][] = ['label' => 'Transacciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
date_default_timezone_set('America/Santo_Domingo');
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
						<!-- <a href="/frontend/web/clientes">Clientes</a> -->
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
						<!-- <a href="#">Registro de clientes</a> -->
					</li>
				</ul>
				<div class="ml-md-auto py-2 py-md-0">
                    <?= Html::a('<i class="fas fa-arrow-left"></i> Atras', [$view], ['class' => 'btn btn-outline-secondary btn-xs']) ?>
                    <?= Html::a('<i class="fas fa-trash text-danger"></i> Eliminar', ['delete', 'id' => $model->id, 'view' => $view], [
                            'data' => [
                                'confirm' => '¿Está seguro/a que desea eliminar este registro?',
                                'method' => 'post',
                            ], 'class' => 'btn btn-outline-danger btn-xs'
                        ]); ?>
                </div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="card-title"><?= Html::encode($this->title) ?></div>
						</div>
						<?= $this->render('_form', [
					        'model' => $model,
            				'cuentas' => $cuentas,
            				'colaborador_id' => $colaborador_id,
					    ]) ?>
						
					</div>
				</div>
			</div>
		</div>
	</div>

</div>


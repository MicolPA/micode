<?php 


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$fecha_proxima = date("Y-m-d",strtotime($model->fecha_comienzo."+ $model->tiempo_estimado weeks"));
$fecha1 = $model->status == 3 ? new \DateTime($model->fecha_comienzo) : new \DateTime(date("Y-m-d"));
$fecha2 = $model->status == 3 ? new \DateTime($model->fecha_finalizacion) : new \DateTime($fecha_proxima);
$diff = $fecha1->diff($fecha2);

$this->title = $model->empresa;
 ?>

<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Clientes</h4>
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
						<a href="/frontend/web/clientes">Clientes</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
						<a href="#">Perfil del cliente</a>
					</li>
				</ul>
				<div class="ml-md-auto py-2 py-md-0">
					<a class="btn btn-warning btn-sm" href="#" data-toggle="modal" data-target="#cambiarStatus"><i class="fas fa-exclamation mr-2"></i><span class="text">Cambiar Status</span></a>
                    <?= Html::a('<i class="fas fa-plus mr-1"></i> Factura', ['facturas/registrar', 'cliente_id' => $model->id], ['class' => 'btn btn-dark btn-sm']) ?>
                    <?= Html::a('<i class="fas fa-pencil-alt"></i>', ['editar', 'id' => $model->id], ['class' => 'btn btn-success btn-sm']) ?>
                    <?= Html::a('<i class="fas fa-trash text-white"></i>', ['delete', 'id' => $model->id], [
                            'data' => [
                                'confirm' => '¿Está seguro/a que desea eliminar este registro?',
                                'method' => 'post',
                            ], 'class' => 'btn btn-danger btn-sm'
                        ]); ?>
                </div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="row">
							<div class="col-md-3">
								<div class="card p-3 m-3 ">
									<img src="/frontend/web/<?= $model->logo_url ?>" width='100%'>
								</div>
							</div>
							<div class="col-md-9">
								<div class="p-2 pt-4">
									<h2 class="font-weight-bold mb-1"><?= $model->empresa ?> <span class="badge badge-pill badge-success mb-2"><?= $model->tipoServicio->nombre ?></span></h2>
									
									<p class="h4 font-weight-normal"><i class="fas fa-circle fa-xs text-<?= $model->status0->color ?>"></i> <?= $model->status0->nombre ?></p>
									<?php if ($model->status != 3): ?>
										<p class="h4 font-weight-normal"><i class="fas fa-circle fa-xs text-dark"></i> <?= $model->tiempo_estimado ?> Semanas (<?= date("Y-m-d") > $fecha_proxima ? "Retraso de $diff->days días" : "$diff->days días restantes" ?>)</p>
									<?php else: ?>
										<p class="h4 font-weight-normal"><i class="fas fa-circle fa-xs text-dark"></i> Finalizado el <?= $model->fecha_finalizacion ?> (realizado en <?= $diff->d ?> días)</p>
									<?php endif ?>
									<p class="h4 font-weight-normal"><i class="fas fa-circle fa-xs text-dark"></i> <?= number_format($model->importe_base) ?> (Importe base) / <?= $model->pago_mensual == 1 ? "Pago mensual" : " Pago único" ?></p>
									<p class="h4 font-weight-normal"><i class="fas fa-circle fa-xs text-dark"></i> Comienzo estimado el <?= $model->fecha_comienzo ?></p>
									<p class="h4 font-weight-normal"><i class="fas fa-circle fa-xs text-dark"></i> <a href="https://<?= $model->dominio ?>" target='_blank'><?= $model->dominio ?></a></p>

								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<h4 class="card-title float-left w-20">Información</h4>
								<a href="javascript:addImporte(<?= $model->id ?>, '/clientes/perfil?id=<?= $model->id ?>')" class="btn btn-primary btn-round float-right btn-sm" id='alert_demo_5'><i class="fas fa-plus-circle mr-2"></i>Registrar Importe</a>
						</div>
						<div class="card-body">
							<ul class="nav nav-pills nav-secondary nav-pills-no-bd" id="pills-tab-without-border" role="tablist">
								<li class="nav-item mr-2">
									<a class="nav-link active" id="pills-home-tab-nobd" data-toggle="pill" href="#pills-home-nobd" role="tab" aria-controls="pills-home-nobd" aria-selected="true"><i class="fas fa-user-ninja mr-2"></i> Representante</a>
								</li>
								<li class="nav-item" style="margin-left: 0 !important">
									<a class="nav-link" id="pills-profile-tab-nobd" data-toggle="pill" href="#pills-profile-nobd" role="tab" aria-controls="pills-profile-nobd" aria-selected="false"><i class="fas fa-history mr-2"></i> Historial de pagos</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="pills-profile-tab-nobd" data-toggle="pill" href="#pills-anotaciones-nobd" role="tab" aria-controls="pills-profile-nobd" aria-selected="false"><i class="fas fa-sticky-note mr-2"></i> Anotaciones</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="pills-profile-tab-nobd" data-toggle="pill" href="#pills-facturas-nobd" role="tab" aria-controls="pills-profile-nobd" aria-selected="false"><i class="fas fa-file-invoice-dollar mr-2"></i> Facturas</a>
								</li>
							</ul>
							<div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
								<div class="tab-pane fade show pt-4 active" id="pills-home-nobd" role="tabpanel" aria-labelledby="pills-home-tab-nobd">

									<p class="h4 font-weight-normal"><i class="fas fa-user mr-2"></i> <?= $model->representante_nombre ?></p>
									<p class="h4 font-weight-normal"><i class="fas fa-phone mr-2"></i> <?= $model->representante_telefono ?></p>
									<p class="h4 font-weight-normal"><i class="fas fa-envelope mr-2"></i> <?= $model->representante_correo ? $model->representante_correo : 'No registrado' ?></p>

								</div>
								<div class="tab-pane fade" id="pills-profile-nobd" role="tabpanel" aria-labelledby="pills-profile-tab-nobd">
									<ol class="activity-feed">
										<?php foreach ($pagos as $pago): ?>
											<?php $class = $pago->tipo_id == 2 ? "danger" : 'success' ?>
											<li class="feed-item feed-item-<?= $class ?>">
			                                    <div class="col-md-8">
			                                    	<time class="date" datetime="9-24"><?= $pago->fecha_pago ?></time>
			                                    	<span class="text"><?= $pago->tipo->nombre ?> <a href="/frontend/web/transacciones/editar?id=<?= $pago->id ?>&view=/clientes/perfil?id=<?= $model->id ?>&tipo=<?= $pago->tipo_id ?>&cliente=<?= $pago->cliente_id ?>"><?= $pago->servicioExtra->nombre ?></a> <span class="float-right badge-pill badge-<?= $class ?>">RD$<?= number_format($pago->total) ?></span> </span>
			                                    </div>
			                                </li>	
										<?php endforeach ?>
		                            </ol>
								</div>

								<div class="tab-pane fade" id="pills-anotaciones-nobd" role="tabpanel" aria-labelledby="pills-home-tab-nobd">

									<div class="col-md-6">
										<div class=" card-round">
											<div class="card-body">
												<div class="card-title fw-mediumbold">Anotaciones de usuarios</div>
												<div class="card-list">
													<?php foreach ($users as $user): ?>
														<?php $anotacion = \frontend\models\Anotaciones::find()->where(['user_id' => $user->id, 'cliente_id' => $model->id])->one(); ?>
														<div class="item-list">
															<div class="avatar">
																<img src="/frontend/web/<?= $user->photo_url ?>" alt="..." class="avatar-img rounded-circle">
															</div>
															<div class="info-user ml-3">
																<div class="h4 text-primary"><?= $user->first_name . " " . $user->last_name ?></div>
																<div class="h5"><b>Última modificación</b>: <?= $anotacion ? $anotacion['ultima_modificacion'] : 'no ha realizado anotaciones.' ?></div>
															</div>
															<?php if ($user->id == Yii::$app->user->identity->id): ?>
																<?php if ($anotacion): ?>
																	<a href="/frontend/web/anotaciones/ver?cliente_id=<?= $model->id ?>&id=<?= $anotacion->id ?>" class="btn btn-icon btn-primary btn-round btn-xs"><i class="fa fa-pen fa-xs"></i></a>
																	<?php else: ?>
																		<a href="/frontend/web/anotaciones/ver?cliente_id=<?= $model->id ?>" class="btn btn-icon btn-primary btn-round btn-xs"><i class="fa fa-plus fa-xs"></i></a>
																<?php endif ?>
															<?php else: ?>
																<?php if ($anotacion): ?>
																	<a href="/frontend/web/anotaciones/ver?cliente_id=<?= $model->id ?>&id=<?= $anotacion->id ?>" class="btn btn-icon btn-primary btn-round btn-xs"><i class="fas fa-eye fa-xs"></i></a>
																	<?php else: ?>
																		<a href="/frontend/web/anotaciones/ver?cliente_id=<?= $model->id ?>" class="btn btn-icon btn-primary btn-round btn-xs disabled"><i class="fas fa-eye fa-xs"></i></a>
																<?php endif ?>
															<?php endif ?>
														</div>
													<?php endforeach ?>
													
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane fade" id="pills-facturas-nobd" role="tabpanel" aria-labelledby="pills-anotaciones-tab-nobd">
									<ol class="activity-feed">
										<?php foreach ($facturas as $factura): ?>
                    					<p><?= Html::a("<i class='fas fa-link mr-1'></i> $factura->asunto <i class='fas fa-external-link-alt fa-xs ml-2'></i>", ['facturas/ver', 'id' => $factura->id], ['target' => '_blank']) ?></p>
										<?php endforeach ?>
		                            </ol>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="cambiarStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Cambiar Status</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <?php $form = ActiveForm::begin(['method' => 'post', 'action' => "/frontend/web/clientes/editar?id=$model->id"]); ?>
            <?php echo $form->field($model, 'status')->dropDownList(ArrayHelper::map(\frontend\models\ClientesEstatus::find()->orderBy(['nombre'=>SORT_ASC])->all(), 'id', 'nombre'),['prompt'=>'Seleccionar...', 'class' => 'form-control input-r border-blue select_2',]); ?>

            <?= $form->field($model, 'fecha_finalizacion')->textInput(['type' => 'date']) ?>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                <?= Html::submitButton('Modificar', ['class' => 'btn btn-primary btn-sm']) ?>
          </div>
            <?php ActiveForm::end(); ?>
        </div>
      </div>
    </div>
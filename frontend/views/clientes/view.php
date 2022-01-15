<?php 


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$servicio = new \common\models\Servicios();
$this->title = $model->empresa;

$ingresos = \frontend\models\Transacciones::find()->where(['cliente_id' => $model->id, 'tipo_id' => 1])->sum("total");
$gastos = \frontend\models\Transacciones::find()->where(['cliente_id' => $model->id, 'tipo_id' => 2])->sum("total");
$neto = $ingresos - $gastos;

?>



<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<?php  
            echo $this->render('/layouts/breadcrumb', 
                    ['modulo' => "Clientes", 'modulo_url' => "/frontend/web/clientes", 'pagina' => 'Perfil del cliente']); 
                ?>
				<div class="ml-md-auto py-2 py-md-0">
            <?= Html::a('<i class="fas fa-plus mr-1"></i> Registrar Factura', ['facturas/registrar', 'cliente_id' => $model->id], ['class' => 'btn btn-success btn-sm']) ?>
            <?= Html::a('<i class="fas fa-pencil-alt"></i>', ['editar', 'id' => $model->id], ['class' => 'btn btn-dark btn-sm']) ?>
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
					<div class="card p-3">
						<div class="row">
							<div class="col-md-3">
								<div class="card mt-2 p-0">
									<div style="background-image: url(/frontend/web/<?= $model->logo_url ? $model->logo_url : 'images/logo-goes-here.png' ?>);background-size: contain;background-repeat: no-repeat;background-position: center;height: 250px;">
									</div>
								</div>
								<div class="m-3">
									<h2 class="font-weight-bold mb-2"><?= $model->empresa ?> </h2>
									<?php if ($model->dominio): ?>
										<p class="h4 font-weight-normal"><i class="fas fa-laptop fa-xs text-dark mr-2"></i> <a href="https://<?= $model->dominio ?>" target='_blank'><?= $model->dominio ?></a></p>
									<?php endif ?>
									<p class="h4 font-weight-normal"><i class="fas fa-user mr-2"></i> <?= $model->representante_nombre ? $model->representante_nombre : "No registrado" ?></p>
									<p class="h4 font-weight-normal"><i class="fas fa-phone mr-2"></i> <?= $model->representante_telefono ? $model->representante_telefono : "No registrado"; ?></p>
									<p class="h4 font-weight-normal"><i class="fas fa-envelope mr-2"></i> <?= $model->representante_correo ? $model->representante_correo : 'No registrado' ?></p>
									<p class="h4 font-weight-normal"><i class="fas fa-calendar-alt mr-2"></i> <?= $servicio->formatDate($model->date, 1) ?></p>

								</div>
							</div>
							<div class="col-md-9">
								<div class="card">
						<div class="card-header">
							<h4 class="card-title float-left w-20 font-weight-bold">Información</h4>
						</div>
						<div class="card-body">
							<ul class="nav nav-pills nav-secondary nav-pills-no-bd" id="pills-tab-without-border" role="tablist">
								<li class="nav-item">
									<a class="nav-link pt-1 pb-1 pr-3 pl-3 border-0" id="pills-profile-tab-nobd" data-toggle="pill" href="#pills-transacciones-nobd" role="tab" aria-controls="pills-profile-nobd" aria-selected="false"><i class="fas fa-history mr-2"></i> Historial de transacciones</a>
								</li>
								<li class="nav-item">
									<a class="nav-link active pt-1 pb-1 pr-3 pl-3 border-0" id="pills-profile-tab-nobd" data-toggle="pill" href="#pills-totales-nobd" role="tab" aria-controls="pills-profile-nobd" aria-selected="false"><i class="fas fa-dollar-sign mr-2"></i> Totales</a>
								</li>
								<li class="nav-item">
									<a class="nav-link pt-1 pb-1 pr-3 pl-3 border-0" id="pills-profile-tab-nobd" data-toggle="pill" href="#pills-facturas-nobd" role="tab" aria-controls="pills-profile-nobd" aria-selected="false"><i class="fas fa-file-invoice-dollar mr-2"></i> Facturas</a>
								</li>
								<li class="nav-item">
									<a class="nav-link pt-1 pb-1 pr-3 pl-3 border-0" id="pills-profile-tab-nobd" data-toggle="pill" href="#pills-anotaciones-nobd" role="tab" aria-controls="pills-profile-nobd" aria-selected="false"><i class="fas fa-sticky-note mr-2"></i> Anotaciones</a>
								</li>
							</ul>
							<div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
								
								<div class="tab-pane" id="pills-anotaciones-nobd" role="tabpanel" aria-labelledby="pills-home-tab-nobd">
									<div class="col-md-12 p-0">
										<div class="card-round">
											<div class="card-body p-0">
												<div class="card-list">
													<?php 

													$anotacion = \frontend\models\Anotaciones::find()->where(['user_id' => Yii::$app->user->identity->id, 'cliente_id' => $model->id])->one();

													if (!$anotacion) {
														$anotacion = new \frontend\models\Anotaciones();
													}
														echo $this->render('/anotaciones/_form', ['model' => $anotacion])
													?>
													
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane fade" id="pills-facturas-nobd" role="tabpanel" aria-labelledby="pills-anotaciones-tab-nobd">
									<?php if (count($facturas) > 0): ?>
										<ol class="activity-feed list-wrapper">

											<?php foreach ($facturas as $factura): ?>
												<li class="feed-item feed-item-gray list-item">
													<time class="date" datetime="9-25"><?= $servicio->formatDate($factura->date) ?></time>
													<!-- <span class="text">#<?//= $factura->factura_code ?>  -->
														<u><a href="/frontend/web/facturas/ver?id=<?= $factura->id ?>"><?= $factura->asunto ?></a></u>

														<span class="tooltip">hola</span>
													</span>
												</li>
											
											<?php endforeach ?>
						              	</ol>
						              	<?php if (count($facturas) > 4): ?>
						              		<div id="pagination-container" class="pl-lg-4 pl-md-4"></div>
						              	<?php endif ?>
					              	<?php else: ?>
					             	<p class="mt-4">No se han registrado facturas de este cliente.</p>	
									<?php endif ?>
								</div>

								<div class="tab-pane fade active show pt-4" id="pills-totales-nobd" role="tabpanel" aria-labelledby="pills-home-tab-nobd">
									<ol class="activity-feed">
										<li class="feed-item feed-item-info">
		                    <div class="col-md-8">
		                        <time class="date" datetime="9-24">Totales</time>
		                          <span class="text">
		                            Ingresos totales
		                          	<span class="float-right badge-pill badge-info">RD$<?= number_format($ingresos) ?></span>
		                          </span>
		                    </div>
		                </li>
                  	<li class="feed-item feed-item-danger">
                      	<div class="col-md-8">
                        	<time class="date" datetime="9-24">Totales</time>
                          	<span class="text">
                            	Gastos totales
                          		<span class="float-right badge-pill badge-danger">RD$<?= number_format($gastos) ?></span>
                          	</span>
                      	</div>
                  	</li>
                  	<li class="feed-item feed-item-success">
                      	<div class="col-md-8">
                        	<time class="date" datetime="9-24">Totales</time>
                          		<span class="text">
                            	Ingresos neto
                          		<span class="float-right badge-pill badge-success font-weight-bold">RD$<?= number_format($neto) ?></span>
                          </span>
                      </div>
                  	</li>
									</ol>
								</div>

								<div class="tab-pane" id="pills-transacciones-nobd" role="tabpanel" aria-labelledby="pills-profile-tab-nobd">
									<ol class="activity-feed">
										<?php if (count($pagos) > 0): ?>
										<?php foreach ($pagos as $pago): ?>
                        <?php 
                            $text = $pago->tipo->nombre;
                            $text2 = $pago->servicioExtra->nombre;
                        ?>
                        <?php $class = $pago->tipo_id == 2 ? "danger" : 'success' ?>
                        <li class="feed-item feed-item-<?= $class ?>">
                            <div class="col-md-10">
                                <time class="date" datetime="9-24"><?= $pago->fecha_pago ?></time>
                                <span class="text">
                                    <?= $text . ' por concepto de: ' ?> 
                                    <a href="/frontend/web/transacciones/editar?id=<?= $pago->id ?>&view=/clientes/perfil?id=<?= $model->id ?>&tipo=<?= $pago->tipo_id ?>&cliente=<?= $pago->cliente_id ?>">
                                          <?= $pago->servicioExtra->nombre ?>
                                        <?php if ($pago->concepto): ?>
                                            <a class='text-warning' href="#" data-toggle="tooltip" data-placement="top" title="<?= $pago->concepto ?>">
                                              <i class="ml-2 fas fa-comment-dots"></i>
                                            </a>
                                        <?php endif ?>
                                      </a> 
                                	<span class="float-right badge-pill badge-<?= $class ?>">RD$<?= number_format($pago->total) ?></span>
                                 </span>
                            </div>
                        </li>   
                    	<?php endforeach ?>
                    	<?php else: ?>
                    		Aún no se han registrados transacciones con este cliente.
										<?php endif ?>
				          </ol>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	setTimeout(function(){
		var items = $(".list-wrapper .list-item");
	    var numItems = items.length;
	    var perPage = 4;

	    items.slice(perPage).hide();

	    $('#pagination-container').pagination({
	        items: numItems,
	        itemsOnPage: perPage,
	        prevText: "&laquo;",
	        nextText: "&raquo;",
	        onPageClick: function (pageNumber) {
	            var showFrom = perPage * (pageNumber - 1);
	            var showTo = showFrom + perPage;
	            items.hide().slice(showFrom, showTo).show();
	        }
	    });
	},1500)
</script>
<?php 


$fecha_proxima = date("Y-m-d",strtotime($model->fecha_comienzo."+ $model->tiempo_estimado weeks"));
$fecha1= new \DateTime(date("Y-m-d"));
$fecha2= new \DateTime($fecha_proxima);
$diff = $fecha1->diff($fecha2);

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
								<div class="pt-4">
									<h2 class="font-weight-bold mb-1"><?= $model->empresa ?> <span class="badge badge-pill badge-success mb-2"><?= $model->tipoServicio->nombre ?></span></h2>
									
									<p class="h4 font-weight-normal"><i class="fas fa-circle fa-xs text-<?= $model->status0->color ?>"></i> <?= $model->status0->nombre ?></p>
									<p class="h4 font-weight-normal"><i class="fas fa-circle fa-xs text-dark"></i> <?= $model->tiempo_estimado ?> Semanas (<?= $diff->days ?> días restantes)</p>
									<p class="h4 font-weight-normal"><i class="fas fa-circle fa-xs text-dark"></i> <?= number_format($model->importe_base) ?> (Importe base) / <?= $model->pago_mensual == 1 ? "Pago mensual" : " Pago único" ?></p>
									<p class="h4 font-weight-normal"><i class="fas fa-circle fa-xs text-dark"></i> Comienzo estimado el <?= $model->fecha_comienzo ?></p>

								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<h4 class="card-title">Información</h4>
						</div>
						<div class="card-body">
							<ul class="nav nav-pills nav-secondary nav-pills-no-bd" id="pills-tab-without-border" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="pills-home-tab-nobd" data-toggle="pill" href="#pills-home-nobd" role="tab" aria-controls="pills-home-nobd" aria-selected="true"><i class="fas fa-user-ninja mr-2"></i> Representante</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="pills-profile-tab-nobd" data-toggle="pill" href="#pills-profile-nobd" role="tab" aria-controls="pills-profile-nobd" aria-selected="false"><i class="fas fa-history mr-2"></i> Historial de pagos</a>
								</li>
							</ul>
							<div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
								<div class="tab-pane fade show pt-4 active" id="pills-home-nobd" role="tabpanel" aria-labelledby="pills-home-tab-nobd">

									<p class="h3"><?= $model->representante_nombre ?></p>
									<p class="h4 font-weight-normal"><i class="fas fa-phone mr-2"></i> <?= $model->representante_telefono ?></p>
									<p class="h4 font-weight-normal"><i class="fas fa-envelope mr-2"></i> <?= $model->representante_correo ?></p>

								</div>
								<div class="tab-pane fade" id="pills-profile-nobd" role="tabpanel" aria-labelledby="pills-profile-tab-nobd">
									<ol class="activity-feed">
                                <li class="feed-item feed-item-secondary">
                                    <time class="date" datetime="9-25">Sep 25</time>
                                    <span class="text">Responded to need <span class="ml-4 badge badge-dark">8,000</span></span>
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
	</div>
</div>
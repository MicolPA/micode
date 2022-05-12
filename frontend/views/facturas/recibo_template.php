<?php 

$servicios = new \common\models\Servicios();
$total = count($detalles);
$faltantes = 8 - $total;
$subtotal = 0;
$config = \frontend\models\Configuracion::findOne(1);

 ?>
<html style="min-height: 100%; position: relative;">

<style>
	
</style>
	<!-- <img src="/frontend/web/images/formas-top.png" width="100%"> -->
	<div style="padding-left:33;">
		<div style="height: 100px"></div>
		<div style="padding: -30px 40px 0px -4px;">
			<div style="width: 60%;display:inline-block;float: left;padding-top: -2rem">
				<!-- <img src="/frontend/web/images/Logo lineal.png" width="180px"> -->
				<p style="font-weight: 300 !important;letter-spacing: 10px;font-size:16px;">RECIBO </p>
				
					<?php if ($model->comprobante): ?>
						<p style="font-size:11px;color:#4f4f4f; font-weight: lighter;">
							<br>
							<span style="font-weight:bold">NCF:</span> <?= $config['ncf'] ?> <br>
								<?= $model->comprobante ?>
						</p>
							<?php endif ?>

				<div style="margin-top:1.2rem">
					<b style="font-size:8px">Dirigida a:</b>
					<p style="color:#4f4f4f;font-size:8px;margin-bottom: 0px;">
						<?php if (isset($model->cliente->representante_nombre)): ?>
							<?php 

								if ($model->cliente->representante_nombre) {
									echo $model->cliente->representante_nombre .  " (" .$model->cliente->empresa . ")";
								}else{
									echo $model->cliente->empresa;
								}

							 ?>
						<?php else: ?>
							<?= $model->cliente_nombre ?>
						<?php endif ?>
						<p style="color:#4f4f4f;font-size:8px;"><?= $servicios->formatDate($model->date, 1) ?></p>
					</p>
				</div>
			</div>

			<div style="width:40%;display:inline-block;float: left;text-align: right;margin-top: -2rem;margin-bottom: 1rem;">
				<img src="<?= $config['logo_factura_url'] ?>" width="80px" style="margin-bottom:2px">
				<p style="font-size:8px;color:#4f4f4f; font-weight: lighter;">
					<br>
					<?php if ($config['rnc']): ?>
						<span style="font-weight:bold">RNC:</span> <?= $config['rnc'] ?> <br>
					<?php endif ?>
					<?php if ($config['direccion']): ?>
						<?= $config['direccion'] ?><br>
					<?php endif ?>
					<?php if ($config['correo']): ?>
						<?= $config['correo'] ?><br>
					<?php endif ?>
					<?= $config['telefono'] ?>
				</p>
				<!-- <p style="font-weight: 300 !important;letter-spacing: 10px;font-size:20px;">FACTURA</p> -->
			</div>
			<div style="margin-top: 0.2rem;padding: 0px;">
				<table class="table table-striped" style="">
					<thead>
						<tr style="border: 0px !important;background-color: #f2f2f2">
							<th style="border: 0px !important;color:#444;background-color: #f2f2f2">Detalle</th>
							<th style="border: 0px !important;color:#444;text-align: left;background-color: #f2f2f2">Precio</th>
							<th style="border: 0px !important;color:#444;text-align: left;background-color: #f2f2f2">Total</th>
						</tr>
					</thead>
					<tbody>
						<?php $color_count = 0; ?>
						<?php foreach ($detalles as $d): ?>
							<?php 

							$subtotal += $d->total; 
							$color_count++ ;

							?>
							<tr>
								<td style='font-size: 12px;padding:10px 10px;width:75%;'><?= $d->descripcion ?> <?= $d->cantidad ? "x$d->cantidad" : "" ?></td>
								<td style='font-size: 12px;padding:10px 10px;text-align: left;width:25%;'><?= $d->precio > 0 ? "$". number_format($d->precio,2) : 'N/A' ?></td>
								<td style='font-size: 12px;padding:10px 10px;text-align: left;width:25%;font-weight: bold;'><?= $d->total > 0 ? "$". number_format($d->total,2) : 'N/A' ?></td>
							</tr>
						<?php endforeach ?>
						<?php if ($faltantes > 0): ?>
							<?php for ($i=0;$i<=$faltantes;$i++): ?>
								<?php  $color_count++ ?>
								
								<?php $color_count = 0 ?>
								<tr>
									<td style='border: 0px !important;padding:20px 10px;color:#fff'>$<?= $i ?></td>
									<td style='border: 0px !important;padding:20px 10px;color:#fff'>$<?= $i ?></td>
									<td style='border: 0px !important;padding:20px 10px;color:#fff'>$<?= $i ?></td>
									<!-- <td style='padding:20px 10px;color: #000;;background-color: #f2f2f2;'>hola</td> -->
									<!-- <td style='padding:20px 10px;color: #000;;background-color: #f2f2f2;'>-</td> -->
								</tr>
									
							<?php endfor ?>
						<?php endif ?>
					</tbody>
					<?php 
						$config['impuestos'] = $config['impuestos'] < 1 ? 1 : $config['impuestos'];
						$itbis = ($config['impuestos'] * $subtotal ) / 100;
						// $itbis = ($subtotal * 100 ) / $config['impuestos'];
						$monto_total = $subtotal + $itbis; 

					 ?>
					 <hr>
					<tr>
						<td style=';font-size: 22px !important;padding:10px 10px;text-align: left;width:75%;font-weight: bold;'><h4>Subtotal</h4></td>
						<td style=';font-size: 12px;padding:10px 10px;text-align: left;width:25%;'></td>
						<td style=';font-size: 12px;padding:10px 10px;text-align: left;width:25%;font-weight: bold;'>
							<h4>RD$<?= number_format($subtotal,2) ?></h4>
						</td>
					</tr>
					<tr>
						<td style=';font-size: 22px !important;padding:10px 10px;text-align: left;width:75%; font-weight: bold;'><h4>ITBIS</h4></td>
						<td style=';font-size: 12px;padding:10px 10px;text-align: left;width:25%;'></td>
						<td style=';font-size: 12px;padding:10px 10px;text-align: left;width:25%;font-weight: bold;'>
							<h4>RD$<?= number_format($itbis,2) ?></h4>
						</td>
					</tr>
					<tr>
						<td style=';font-size: 22px !important;padding:10px 10px;text-align: left;width:75%;font-weight: bold;'><h4>Total</h4></td>
						<td style=';font-size: 12px;padding:10px 10px;text-align: left;width:25%;'></td>
						<td style=';font-size: 12px;padding:10px 10px;text-align: left;width:25%;font-weight: bold;'>
							<h3>RD$<?= number_format($monto_total,2) ?></h3>
						</td>
					</tr>
				</table>
				<!-- <hr style="color:#ccc;background: #ccc;"> -->
			</div>
		</div>
	</div>
</html>

<?php 

$servicios = new \common\models\Servicios();
$total = count($detalles);
$faltantes = 4 - $total;
$subtotal = 0;
$config = \frontend\models\Configuracion::findOne(1);
 ?>
<html style="min-height: 100%; position: relative;margin-top: 1rem;">

<style>
	
</style>
	<!-- <img src="/frontend/web/images/formas-top.png" width="100%"> -->
	<div style="padding: 0px 40px;margin-top: 2rem !important;padding-top: 3rem;">
		<div style="width: 50%;display:inline-block;float: left;">
			<!-- <img src="/frontend/web/images/Logo lineal.png" width="180px"> -->
			<p style="font-weight: bold !important;letter-spacing: 10px;font-size:28px;font-family: poppins;"><?= $model->cotizacion ? "COTIZACIÓN" : "FACTURA" ?></p>
		</div>

		<div style="width:50%;display:inline-block;float: left;text-align: right;">
			<?php if ($config['logo_factura_url']): ?>
					<img src="<?= $config['logo_factura_url'] ?>" width="120px">
				<?php endif ?>
				<p style="font-size:12px;color:#4f4f4f; font-weight: lighter;">
					<br>
					<?php if (!$config['logo_factura_url']): ?>
						<span style="font-weight:bold;margin-bottom: 0px;font-size: 14px;display: block;">
							<?= $config['empresa'] ?>
						</span>
						<br>
					<?php endif ?>
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
			<br>
			<!-- <p style="font-weight: 300 !important;letter-spacing: 10px;font-size:20px;">FACTURA</p> -->
		</div>

		<!-- <div style="width:30%;display: inline-block;">
			<p style="font-weight: bold">Fecha</p>
			<span><?= $servicios->formatDate($model->date) ?></span>
			
		</div> -->

		<div style="width: 40%;background:#0A7DBF;float: left;text-align: center;margin-bottom: 0rem;margin-top: -3rem">
			<p style="font-weight: 300 !important;margin:5px;color:#fff;font-weight: bold">Fecha: <?= $servicios->formatDate($model->date) ?></p>
		</div>

		<div style="width: 100%;background: #fff;;margin-top: -0rem">
			<p style="font-weight: 300 !important;margin:5px;color:#242335;"><span style="font-weight: bold">Dirigida a:</span> 
				<?php if (isset($model->cliente->representante_nombre)): ?>
					<?= $model->cliente->representante_nombre .  " (" .$model->cliente->empresa . ")" ?>
				<?php else: ?>
					<?= $model->cliente_nombre ?>
				<?php endif ?>
			</p>
			<?php if ($model->comprobante and isset($model->cliente->rnc)): ?>
				<p style="font-weight: 300 !important;margin:5px;color:#242335;">
					<span style="font-weight: bold">RNC o Cédula:</span> <?= $model->cliente->rnc ?>
					&nbsp; | &nbsp; <span style="font-weight: bold">NCF:</span> <?= $model->comprobante ?></p>
			<?php endif ?>
			<p style="font-weight: 300 !important;margin:5px;color:#242335;"><span style="font-weight: bold">Por concepto de:</span> <?= $model->asunto ?></p>
		</div>

		<div style="margin-top: .5rem">
			<table class="table table-striped">
				<thead>
					<!-- <tr style="border: 0px !important">
						<th style="background: #56dfe4 !important;border: 0px !important;color:#444">Detalle</th>
						<th style="background: #56dfe4 !important;border: 0px !important;color:#444">Total</th>
					</tr> -->
					<tr style="border: 0px !important">
						<th style="border: 0px !important;color:#444">Detalle</th>
						<th style="border: 0px !important;color:#444;text-align: right;">Total</th>
					</tr>
				</thead>
				<tbody>
					<?php $color_count = 0; ?>
					<?php foreach ($detalles as $d): ?>
						<?php $subtotal += $d->precio; $color_count++ ?>
						<?php if ($color_count == 1): ?>
							<tr>
								<td style='padding:20px 10px;width:60%;'><?= $d->descripcion ?></td>
								<td style='padding:20px 10px;text-align: right;'>$<?= number_format($d->precio,2) ?></td>
							</tr>
						<?php else: ?>
							<?php $color_count = 0 ?>
							<tr>
								<td style='padding:20px 10px;background-color: #f2f2f2;width:60%;'><?= $d->descripcion ?></td>
								<td style='padding:20px 10px;background-color: #f2f2f2;text-align: right;'>$<?= number_format($d->precio,2) ?></td>
							</tr>
						<?php endif ?>
					<?php endforeach ?>
					<?php if ($faltantes > 0): ?>
						<?php for ($i=0;$i<=$faltantes;$i++): ?>
							<?php  $color_count++ ?>
							<?php if ($color_count == 1): ?>
							<tr>
								<td style='padding:20px 10px;color:white'>-</td>
								<td style='padding:20px 10px;color:white'>-</td>
							</tr>
							<?php else: ?>
							<?php $color_count = 0 ?>
							<tr>
								<td style='padding:20px 10px;background-color: #f2f2f2;color:#f2f2f2'><?= $i ?></td>
								<td style='padding:20px 10px;background-color: #f2f2f2;color:#f2f2f2'>$<?= $i ?></td>
								<!-- <td style='padding:20px 10px;color: #000;;background-color: #f2f2f2;'>hola</td> -->
								<!-- <td style='padding:20px 10px;color: #000;;background-color: #f2f2f2;'>-</td> -->
							</tr>
								
							<?php endif ?>
						<?php endfor ?>
					<?php endif ?>
				</tbody>
				
				<!-- <tr>
					<th style='padding:20px 10px;background:#56dfe4;color:#444'>Total</th>
					<th style='padding:20px 10px;background:#56dfe4;color:#444'>RD$<?//= number_format($monto_total,2) ?></th>
				</tr> -->



			</table>
			<?php 
					$impuestos = $model->impuestos < 1 ? 1 : $model->impuestos;
					$itbis = ($impuestos * $subtotal ) / 100;
					// $itbis = ($subtotal * 100 ) / $model->impuestos;
					$monto_total = $subtotal + $itbis; 
					$model->total = $monto_total;
					$model->subtotal = $subtotal;
					$model->save();
				 ?>

			<div>
				<?php if ($model->pagada): ?>
					<div style="width:34%;float: left;display: inline-block;margin-top: -2rem;">
						<img src="/frontend/web/images/sello-pagado.png" width="440px">
					</div>
				<?php else: ?>
					<div style="width:28%;float: left;display: inline-block;margin-top: -2rem;">
						<img src="/frontend/web/images/sello.png" width="440px">
					</div>
				<?php endif ?>
				<div style='padding:0px 10px 10px 10px;color:#000;text-align: right;float: right;display: inline-block;width: 60%;'>
					<br>
					<br>
					<?php if ($model->impuestos): ?>
						<p style="margin-bottom:0px;color:#8b8b8b;font-weight: bold;">Subtotal: <?= $model->moneda ?>$<?= number_format($subtotal, 2) ?></p>
						<p style="margin-bottom:0px;color:#8b8b8b;font-weight: bold;">+ ITBIS: <?= $model->moneda ?>$<?= number_format($itbis, 2) ?></p>
						<span style="color:#0A7DBF;font-size:28px;font-weight: bold;"><?= $model->moneda ?>$<?= number_format($monto_total,2) ?></span>
						<p style="text-align:right;color:#8b8b8b"><?= $model->nota ?></p>
					<?php else: ?>
					<br>Monto Total <br> 
					<span style="color:#0A7DBF;font-size:28px;font-weight: bold;"><?= $model->moneda ?>$<?= number_format($monto_total,2) ?></span>
					<p style="text-align:right;color:#8b8b8b">Todos los impuestos incluidos.</p>
					<?php endif ?>
				</div>

			</div>
		</div>
	</div>
	<div style="position: absolute;
  bottom: 0;">
		<img src="/frontend/web/images/bottom.png" width="100%">
	</div>
</html>

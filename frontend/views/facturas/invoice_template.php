<?php 

$servicios = new \common\models\Servicios();
$total = count($detalles);
$faltantes = 3 - $total;
$monto_total = 0;
 ?>

<div style=";height: 200in;padding: 40px">
	<div style="width: 50%;display:inline-block;float: left;">
		<img src="/frontend/web/images/Logo lineal.png" width="180px">
		<p style="margin-top: 1rem;font-size:12px">
			MCD by M&G <br>
			Distrito Nacional, Santo Domingo <br>
			849-217-0808
		</p>
	</div>

	<div style="width:50%;display:inline-block;float: left;text-align: right;padding-top: 1.5rem">
		<p style="font-weight: 300 !important;letter-spacing: 10px;font-size:20px;">FACTURA</p>
	</div>

	<div style="width: 40%;background:#56dfe4;float: right;text-align: center;margin-bottom: 0rem;margin-top: -1.9rem">
		<p style="font-weight: 300 !important;margin:5px;color:white;font-weight: bold">Fecha: <?= $servicios->formatDate($model->date) ?></p>
	</div>

	<div style="width: 100%;background: #242335;padding: 6px;margin-top: -0rem">
		<p style="font-weight: 300 !important;margin:5px;color:white;"><span style="font-weight: bold">Cliente:</span> <?= $model->cliente->empresa . " / " . $model->cliente->representante_nombre ?></p>
		<p style="font-weight: 300 !important;margin:5px;color:white;"><span style="font-weight: bold">Por concepto de:</span> <?= $model->asunto ?></p>
	</div>

	<div style="margin-top: .0rem">
		<table class="table table-striped">
			<thead>
				<tr style="border: 0px !important">
					<th style="background: #56dfe4 !important;border: 0px !important">Detalle</th>
					<th style="background: #56dfe4 !important;border: 0px !important">Total</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($detalles as $d): ?>
					<?php $monto_total += $d->precio ?>
					<tr>
						<td style='padding:20px 10px'><?= $d->descripcion ?></td>
						<td style='padding:20px 10px'><?= number_format($d->precio) ?></td>
					</tr>
				<?php endforeach ?>
				<?php if ($faltantes > 0): ?>
					<?php for ($i=0;$i<=$faltantes;$i++): ?>
						<tr>
							<td style='padding:20px 10px;color:white'>hola</td>
							<td style='padding:20px 10px;color:white'>hola</td>
						</tr>
					<?php endfor ?>
				<?php endif ?>
			</tbody>
			<tr>
				<th style='padding:20px 10px;background:#242335;color:white'>Total</th>
				<th style='padding:20px 10px;background:#242335;color:white'><?= number_format($monto_total) ?></th>
			</tr>		


		</table>
	</div>
</div>

<?php 
use yii\helpers\Html;


?>

<div class="factura_detalle">
	
	

	<?php $count = 0; ?>
	<?php foreach ($detalles as $detalle): ?>
		<div class="row p-2">
			<div class="col-md-8">
				<div class="form-group descripcion">
					<label>Descripción</label>
					<input type="text" class="form-control" name="factura_descripcion[<?= $count ?>]" value="<?= $detalle->descripcion ?>"> 
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group precio">
					<label>Precio</label>
					<input type="text" class="form-control field-number" name="factura_precio[<?= $count ?>]" placeholder="Dejar vacío si no aplica" value="<?= number_format($detalle->precio, 2) ?>">
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group cantidad">
					<label>Cantidad</label>
					<input type="number" class="form-control" name="factura_cantidad[<?= $count ?>]" placeholder="Dejar vacío si no aplica" value="<?= $detalle->cantidad ?>">
				</div>
			</div>

			<!-- <div class="col-md-1 pt-5 btn_delete">
				<a href="deleteInvoiceLine(<?//= $count ?>)" class="btn btn-danger btn-sm disabled"><i class="fas fa-trash-alt"></i></a>
			</div>	 -->
		</div>
		<?php $count++ ?>
	<?php endforeach ?>
	<div class="invoice">
		<div class="row p-2">
			<div class="col-md-8">
				<div class="form-group descripcion">
					<label>Descripción</label>
					<input type="text" class="form-control" name="factura_descripcion[<?= $count ?>]" maxlength="200" autocomplete="off">
                	<span class="secondary small" style="color:#ccc;font-weight: bold;">Máximo 200 caracteres.</span>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group precio">
					<label>Precio (unidad)</label>
					<input type="text" class="form-control field-number" name="factura_precio[<?= $count ?>]" placeholder="Dejar vacío si no aplica" autocomplete="off">
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group cantidad">
					<label>Cantidad</label>
					<input type="number" class="form-control" name="factura_cantidad[<?= $count ?>]" placeholder="Dejar vacío si no aplica" autocomplete="off">
				</div>
			</div>

			<!-- <div class="col-md-1 pt-5 btn_delete">
				<a href="deleteInvoiceLine(1)" class="btn btn-danger btn-sm disabled"><i class="fas fa-trash-alt"></i></a>
			</div> -->
		</div>
	</div>

	<div class="addInvoice">
		
	</div>

	<div class="row mb-4">
		<div class="col-md-12 text-right mt-4 pr-5">
			<a href="javascript:addInvoiceField(<?= $count ?>)" class="btn btn-xs bg-darkblue text-white btn-sm" id="addInvoiceBtn">Agregar línea</a>
		</div>
	</div>

	<div class="col-md-12 pt-4 pb-4">
        <div class="form-group">
            <?= Html::submitButton('Actualizar Factura', ['class' => 'btn btn-primary pr-5 pl-5 btn-block', 'formtarget' => '_blank', 'id' => 'submitButton']) ?>
        </div>
    </div>

</div>

<script>
	setTimeout(function(){
		$( "#submitButton").click(function() {
			if ($("#factura-form")[0].checkValidity()) {
			  setTimeout(function(){
			  	window.location = "/frontend/web/facturas?type=<?= $model->cotizacion ?>";
			  },1500)
			}
		});
	},500)
</script>
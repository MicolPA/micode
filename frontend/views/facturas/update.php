<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Clientes */

if ($type == 1) {
    $type_name = "Cotización";
}else{
    $type_name = "Factura";
}


date_default_timezone_set('America/Santo_Domingo');
$this->title = "Modificando $type_name";
$view = $w_client ? '_form' : '_form_without_client';
?>
<div class="main-panel">

	<div class="content">
		<div class="page-inner">
			<?php $form = ActiveForm::begin(['id' => 'factura-form']); ?>
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<div class="card-title">
									<?= Html::encode($this->title) ?>
									<div class="cliente-options float-right text-right w-50">
										<label class="selectgroup-item select-cliente-registrado">
	                                        <input type="radio" name="transportation" value="6" class="selectgroup-input" <?= $model->cliente_id ? 'checked' : '' ?>>
	                                        <span class="selectgroup-button selectgroup-button-icon font-12 font-weight-bold pt-1 pb-1">Cliente registrado</span>
	                                    </label>
	                                    <label class="selectgroup-item select-cliente-no-registrado">
	                                        <input type="radio" name="transportation" value="6" class="selectgroup-input" <?= !$model->cliente_id ? 'checked' : '' ?>>
	                                        <span class="selectgroup-button selectgroup-button-icon font-12 font-weight-bold pt-1 pb-1">Cliente sin registrar</span>
	                                    </label>
									</div>
								</div>
							</div>
							<div class="card-body">
								<?= $this->render("_form", [
							        'form' => $form,
							        'model' => $model,
							    ]) ?>
							</div>
							
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<div class="card-title">Detalle</div>
							</div>
							<?= $this->render('_form_details_update', [
						        'model' => $model,
						        'detalles' => $detalles,
						    ]) ?>
							
						</div>
					</div>
				</div>
   	 		<?php ActiveForm::end(); ?>
    		
		</div>
	</div>


</div>

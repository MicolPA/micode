<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Transacciones */

$this->title = 'Registrar Transacción';
$this->params['breadcrumbs'][] = ['label' => 'Transacciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-panel">

	<div class="content">
		<div class="page-inner">
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


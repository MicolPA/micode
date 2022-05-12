<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Configuracion */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Configuracions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="configuracion-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'empresa',
            'favicon',
            'logo_general_url:url',
            'logo_factura_url:url',
            'color_pie_factura',
            'color_precio_total_factura',
            'texto_pie_factura',
            'direccion',
            'telefono',
            'impuestos',
            'rnc',
            'nfc',
        ],
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ConfiguracionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Configuracions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="configuracion-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Configuracion', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'empresa',
            'favicon',
            'logo_general_url:url',
            'logo_factura_url:url',
            //'color_pie_factura',
            //'color_precio_total_factura',
            //'texto_pie_factura',
            //'direccion',
            //'telefono',
            //'impuestos',
            //'rnc',
            //'nfc',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

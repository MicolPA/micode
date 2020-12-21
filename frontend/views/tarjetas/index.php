<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TarjetasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tarjetas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tarjetas-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Tarjetas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre',
            'dinero_total',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

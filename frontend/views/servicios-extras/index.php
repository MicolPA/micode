<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ServiciosExtrasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Servicios Extras';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicios-extras-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Servicios Extras', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre',
            'precio',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

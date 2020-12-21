<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ServiciosExtras */

$this->title = 'Create Servicios Extras';
$this->params['breadcrumbs'][] = ['label' => 'Servicios Extras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicios-extras-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login mt-5 pt-5">

    <div class="row mt-5 pt-5">
        <div class="col-lg-6 m-auto mt-5">
            <img src="/frontend/web/images/Logo lineal.png" width='200px'>
            <div class="mt-3">
                <h1>Bienvenid@ al sistema de gestión de MicodeRD.</h1>
            </div>
        </div>
        <div class="col-lg-6 m-auto card mt-5 pt-4 pb-4">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Usuario') ?>

                <?= $form->field($model, 'password')->passwordInput()->label("Contraseña") ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div class="form-group">
                    <?= Html::submitButton('Iniciar sesión', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

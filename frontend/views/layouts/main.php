<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


if (Yii::$app->user->isGuest) {
    return Yii::$app->response->redirect(['/site/login']);
}else{
}

AppAsset::register($this);

$user = Yii::$app->user->identity;
$config = \frontend\models\Configuracion::findOne(1);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="/frontend/web/images/logo_icono.png">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?> | Micode RD</title>
    <script src="/frontend/web/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Lato:300,400,700,900"]},
            custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['/frontend/web/css/fonts.min.css']},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div id="preloader">
    <div data-loader="circle-side"></div>
</div><!-- /Preload -->
<style>
    
</style>
<div class="wrapper">
    <div class="main-header">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="blue">
            
            <a href="/" class="logo">
                <?php if ($config['logo_general_tipo'] == 1): ?>
                    <img src="<?= $config['logo_general_url'] ?>" alt="navbar brand" class="navbar-brand" style="max-width: 120px;max-height: 50px;">
                <?php else: ?>
                    <img src="<?= $config['logo_general_url'] ?>" alt="navbar brand" class="navbar-brand" style="max-width: 50px;max-height: 50px;">
                <?php endif ?>
                <!-- <img src="/frontend/web/images/logo-white.png" alt="navbar brand" class="navbar-brand" width="110px"> -->
            </a>
            <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <i class="icon-menu"></i>
                </span>
            </button>
            <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <span class="h2"><i class="icon-menu"></i></span>
                </button>
            </div>
        </div>
        <!-- End Logo Header -->

        <!-- Navbar Header -->
        <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
            
            <div class="container-fluid">
                <div class="collapse" id="search-nav">
                    <form class="navbar-left navbar-form nav-search mr-md-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button type="submit" class="btn btn-search pr-1">
                                    <i class="fa fa-search search-icon"></i>
                                </button>
                            </div>
                            <input type="text" placeholder="Search ..." class="form-control">
                        </div>
                    </form>
                </div>
                <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                    <li class="nav-item toggle-nav-search hidden-caret">
                        <a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
                            <i class="fa fa-search"></i>
                        </a>
                    </li>
                <!-- <a href="#" class="nav-link"> -->
                        <!-- <span class="text-white h4">
                            Hola, <?//= "$user->first_name $user->last_name" ?>
                        </span> -->
                    <!-- </a> -->
                   
                    <li class="nav-item dropdown hidden-caret">
                        <!-- <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bell"></i>
                            <span class="notification">4</span>
                        </a> -->
                        <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                            <li>
                                <div class="dropdown-title">You have 4 new notification</div>
                            </li>
                            <li>
                                <div class="notif-scroll scrollbar-outer">
                                    <div class="notif-center">
                                        <a href="#">
                                            <div class="notif-icon notif-primary"> <i class="fa fa-user-plus"></i> </div>
                                            <div class="notif-content">
                                                <span class="block">
                                                    New user registered
                                                </span>
                                                <span class="time">5 minutes ago</span> 
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="notif-icon notif-success"> <i class="fa fa-comment"></i> </div>
                                            <div class="notif-content">
                                                <span class="block">
                                                    Rahmad commented on Admin
                                                </span>
                                                <span class="time">12 minutes ago</span> 
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="notif-img"> 
                                                <img src="/frontend/web/images/profile2.jpg" alt="Img Profile">
                                            </div>
                                            <div class="notif-content">
                                                <span class="block">
                                                    Reza send messages to you
                                                </span>
                                                <span class="time">12 minutes ago</span> 
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="notif-icon notif-danger"> <i class="fa fa-heart"></i> </div>
                                            <div class="notif-content">
                                                <span class="block">
                                                    Farrah liked Admin
                                                </span>
                                                <span class="time">17 minutes ago</span> 
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a class="see-all" href="javascript:void(0);">See all notifications<i class="fa fa-angle-right"></i> </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown hidden-caret">
                        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                            <i class="fas fa-layer-group mr-2"></i> Atajos
                        </a>
                        <div class="dropdown-menu quick-actions quick-actions-info animated fadeIn">
                            <div class="quick-actions-header">
                                <span class="title mb-1">Mis Atajos</span>
                                <span class="subtitle op-8">Shortcuts</span>
                            </div>
                            <div class="quick-actions-scroll scrollbar-outer">
                                <div class="quick-actions-items">
                                    <div class="row m-0">
                                        <a class="col-6 col-md-4 p-0" href="#">
                                            <div class="quick-actions-item">
                                                <i class="flaticon-analytics"></i>
                                                <span class="text">Generated Report</span>
                                            </div>
                                        </a>
                                        <a class="col-6 col-md-4 p-0" href="#" data-toggle="modal" data-target="#registrarImporteModal">
                                            <div class="quick-actions-item">
                                                <i class="flaticon-coins"></i>
                                                <span class="text">Registrar Importe</span>
                                            </div>
                                        </a>
                                        <a class="col-6 col-md-4 p-0" href="/frontend/web/clientes/registrar">
                                            <div class="quick-actions-item">
                                                <i class="flaticon-add-user"></i>
                                                <span class="text">Agregar Cliente</span>
                                            </div>
                                        </a>
                                        <a class="col-6 col-md-4 p-0" href="/frontend/web/facturas/registrar?type=0">
                                            <div class="quick-actions-item">
                                                <i class="flaticon-agenda"></i>
                                                <span class="text">Registrar Factura</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown hidden-caret">
                        <a class="dropdown-toggle nav-link text-white " data-toggle="dropdown" href="#" aria-expanded="false">
                            <i class="fas fa-user mr-1 fa-xs"></i>  Hola, <?= "$user->first_name $user->last_name" ?>
                        </a>
                        <ul class="dropdown-menu dropdown-user animated fadeIn">
                            <div class="dropdown-user-scroll scrollbar-outer">
                                <li>
                                    <div class="user-box">
                                        <div class="u-text">
                                            <h4><?= "$user->first_name $user->last_name" ?></h4>
                                            <p class="text-muted"><?= $user->role->name ?></p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/frontend/web/user/editar?id=<?= $user->id ?>">Mi Perfil</a>
                                    <a class="dropdown-item" href="/frontend/web/site/logout">Cerrar sesión</a>
                                    <!-- <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Account Setting</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Logout</a> -->
                                </li>
                            </div>
                        </ul>
                    </li>
                    
                </ul>
            </div>
        </nav>
        <!-- End Navbar -->
    </div>

    <!-- Sidebar -->
    <div class="sidebar sidebar-style-2">           
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
            <div class="sidebar-content">
                <div class="user">
                    <div class="avatar-sm float-left mr-2">
                        <?php if (file_exists(Yii::getAlias("@web") . '/'. $user->photo_url)): ?>
                            <img src="<?= Yii::getAlias("@web") . '/'. $user->photo_url ?>" alt="..." class="avatar-img rounded-circle">
                        <?php else: ?>
                            <button type="button" class="btn btn-icon btn-round btn-primary font-weight-bold">
                                <?= substr($user->first_name, 0,1) ?>
                            </button>
                        <?php endif ?>
                    </div>
                    <div class="info">
                        <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                            <span>
                                <?= $user->first_name ?>
                                <span class="h5 font-weight-bold"><?= $user->role->name ?></span>
                                <span class="caret"></span>
                            </span>
                        </a>
                        <div class="clearfix"></div>

                        <div class="collapse in" id="collapseExample">
                            <ul class="nav">
                                <li>
                                    <a href="#profile">
                                        <span class="link-collapse">My Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#edit">
                                        <span class="link-collapse">Edit Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#settings">
                                        <span class="link-collapse">Settings</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <ul class="nav nav-info">
                    <li class="nav-item">
                        <a href="/" class="collapsed" aria-expanded="false" style="background:#56BCF7 !important">
                            <i class="fas fa-home text-white font-weight-bold"></i>
                            <p class="text-white font-weight-bold">Dashboard</p>
                        </a>
                    </li>
                    
                    <li class="nav-item <?= strpos(Yii::$app->request->url, 'clientes') ? 'active' : '' ?>">
                        <a href="/frontend/web/clientes/">
                            <i class="fas fa-user"></i>
                            <p>Clientes</p>
                        </a>
                        
                    </li>
                    
                    <li class="nav-item <?= strpos(Yii::$app->request->url, 'transacciones') ? 'active' : '' ?>">
                        <a href="/frontend/web/transacciones">
                            <i class="fas fa-coins"></i>
                            <p>Finanzas</p>
                        </a>
                    </li>
                    <li class="nav-item <?= strpos(Yii::$app->request->url, 'colaboradores') ? 'active' : '' ?>">
                        <a href="/frontend/web/colaboradores">
                            <i class="fas fa-users"></i>
                            <p>Colaboradores</p>
                        </a>
                    </li>
                    <li class="nav-item <?= strpos(Yii::$app->request->url, 'reportes') ? 'active' : '' ?>">
                        <a href="/frontend/web/reportes">
                            <i class="fas fa-chart-bar"></i>
                            <p>Reporte</p>
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                        <a data-toggle="collapse" href="#charts">
                            <i class="far fa-chart-bar"></i>
                            <p>Reportes</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="charts">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="/frontend/web/reportes">
                                        <span class="sub-item">Reporte 1</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="charts/sparkline.html">
                                        <span class="sub-item">Sparkline</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li> -->
                    <li class="nav-item <?= strpos(Yii::$app->request->url, '?type=0') ? 'active' : '' ?>">
                        <a href="/frontend/web/facturas?type=0">
                            <i class="fas fa-file-invoice-dollar"></i>
                            <p>Facturas</p>
                        </a>
                    </li>
                    <li class="nav-item <?= strpos(Yii::$app->request->url, '?type=1') ? 'active' : '' ?>">
                        <a href="/frontend/web/facturas?type=1">
                            <i class="fas fa-file-alt"></i>
                            <p>Cotizaciones</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/frontend/web/servicios/calendario">
                            <i class="fas fa-calendar-alt"></i>
                            <p>Calendario</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/frontend/web/servicios/">
                            <i class="fas fa-money-check-alt"></i>
                            <p>Servicios</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/frontend/web/servicios-extras/">
                            <i class="fas fa-money-bill-alt"></i>
                            <p>Servicios Extras</p>
                        </a>
                    </li>

                    <li class="nav-item <?= strpos(Yii::$app->request->url, 'configuracion') ? 'active' : '' ?>">
                        <a data-toggle="collapse" href="#configuracion">
                            <i class="fas fa-cogs"></i>
                            <p>Configuración</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="configuracion">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="/frontend/web/configuracion/empresa">
                                        <span class="sub-item">Mi Empresa</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/frontend/web/configuracion/facturacion">
                                        <span class="sub-item">Facturación e impuestos</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/frontend/web/tarjetas">
                                        <span class="sub-item">Métodos de pago</span>
                                    </a>
                                </li>
                                <?php if (Yii::$app->user->identity->role_id == 3): ?>
                                <li>
                                    <a href="/frontend/web/planes-configuracion">
                                        <span class="sub-item">Configuración Plan</span>
                                    </a>
                                </li>
                                <?php endif ?>
                            </ul>
                        </div>
                    </li>

                    
                    
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#users">
                            <i class="far fa-user"></i>
                            <p>Usuarios</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="users">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="/frontend/web/user/">
                                        <span class="sub-item">Listado</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/frontend/web/site/signup">
                                        <span class="sub-item">Crear</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- <li class="mx-4 mt-2">
                        <a href="http://themekita.com/atlantis-bootstrap-dashboard.html" class="btn btn-primary btn-block"><span class="btn-label mr-2"> <i class="fa fa-heart"></i> </span>Buy Pro</a> 
                    </li> -->
                </ul>
            </div>
        </div>
    </div>
    <!-- End Sidebar -->


    <div class="">
        <?= $content ?>
    </div>

    <div class="modal fade" id="registrarImporteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Registrar Importe</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <?php $model = new \frontend\models\Transacciones(); ?>
            <?php $form = ActiveForm::begin(['method' => 'get', 'action' => '/frontend/web/transacciones/registrar']); ?>
            <?php $tipos = \frontend\models\TiposImportes::find()->all(); ?>
            <div class="form-group">
                <label for="">Tipo importe</label>
                <select name="tipo" id="" class="form-control" required>
                    <option value="">Seleccionar...</option>
                    <?php foreach ($tipos as $t): ?>
                        <option value="<?= $t->id ?>"><?= $t->nombre ?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <?php $clientes = \frontend\models\Clientes::find()->orderBy(['date' => SORT_DESC])->all(); ?>
            <div class="form-group">
                <label for="">Cliente</label>
                <select name="cliente" id="" class="form-control">
                    <option value="">Seleccionar...</option>
                    <?php foreach ($clientes as $c): ?>
                        <option value="<?= $c->id ?>"><?= $c->empresa ?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <input type="hidden" name="view" value="/transacciones">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                <?= Html::submitButton('Registrar', ['class' => 'btn btn-primary btn-sm']) ?>
          </div>
            <?php ActiveForm::end(); ?>
        </div>
      </div>
    </div>


</div>

<?php if(Yii::$app->session->hasFlash('success')):?>
    <?php
    $msj = Yii::$app->session->getFlash('success');
    echo '<script type="text/javascript">';
    echo "setTimeout(function () { displayNotification('Correcto','$msj','fas fa-check-circle');";
    echo '}, 1000);</script>';
    ?>
<?php endif; ?>  

<!-- <footer class="footer mt-4">
    <div class="container">
        <p class="text-center">&copy; <?//= Html::encode(Yii::$app->name) ?> MICODE <?= date('Y') ?></p>
    </div>
</footer> -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

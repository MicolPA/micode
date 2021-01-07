<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.min.css',
        'css/atlantis.min.css',
        // 'css/demo.css',
        'css/site.css',
    ];
    public $js = [

        //Core JS Files
        'js/core/jquery.3.2.1.min.js',
        'js/core/popper.min.js',
        'js/core/bootstrap.min.js',

        //jQuery UI
        'js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js',
        'js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js',

        //jQuery Scrollbar
        'js/plugin/jquery-scrollbar/jquery.scrollbar.min.js',

        //Chart JS
        'js/plugin/chart.js/chart.min.js',

        //jQuery Sparkline
        'js/plugin/jquery.sparkline/jquery.sparkline.min.js',

        //Chart Circle
        'js/plugin/chart-circle/circles.min.js',

        //Datatables
        'js/plugin/datatables/datatables.min.js',

        //Bootstrap Notify
        'js/plugin/bootstrap-notify/bootstrap-notify.min.js',

        //jQuery Vector Maps
        'js/plugin/jqvmap/jquery.vmap.min.js',
        'js/plugin/jqvmap/maps/jquery.vmap.world.js',

        //Sweet Alert
        'js/plugin/sweetalert/sweetalert.min.js',

        //Atlantis JS
        'js/atlantis.min.js',

        'js/setting-demo.js',
        // 'js/demo.js',
        'js/main.js'
    ];
    public $depends = [
        // 'yii\web\YiiAsset',
        // 'yii\bootstrap\BootstrapAsset',
    ];
}

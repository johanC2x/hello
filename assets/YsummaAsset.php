<?php
namespace app\assets;

use yii\web\AssetBundle;

class YsummaAsset extends AssetBundle {
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/bootstrap.css',
        'css/font-awesome.css',
        'css/custom-styles.css',
        'css/bootstrapValidator.min.css',
        'http://fonts.googleapis.com/css?family=Open+Sans',
        'https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css'
    ];
    public $js = [
        'js/jquery-1.10.2.js',
        //'https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js',
        'js/bootstrap.min.js',
        'js/bootstrapValidator.min.js',
        'https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js',
        'js/jquery.metisMenu.js',
        'js/raphael-2.1.0.min.js',
        'js/morris.js',
        'js/custom-scripts.js',
        'lib/util.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

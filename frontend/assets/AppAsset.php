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
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
    public $css = [
        'css/site.css',
        'css/sidebar.css',
        'css/auth.css',
        'css/projects.css',
        'font/varelaround.css?family=Varela+Round:400,700'
    ];
    public $js = [
        'https://use.fontawesome.com/releases/v5.0.13/js/solid.js',
        'https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js',
        '//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}

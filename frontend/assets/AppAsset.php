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
        'css/site.css',
        'css/sidebar.css',
        'css/auth.css',
    ];
    public $js = [
        'https://use.fontawesome.com/releases/v5.0.13/js/solid.js',
        'https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js',
        //'js/vue.js',
        //'js/vuejsscript.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}

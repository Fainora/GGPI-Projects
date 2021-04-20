<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AuthAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/auth.css',
        'font/varelaround.css?family=Varela+Round:400,700',
    ];
    public $js = [
        'https://use.fontawesome.com/releases/v5.0.13/js/solid.js',
        'https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}

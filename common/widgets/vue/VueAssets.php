<?php
namespace common\widgets\vue;

use yii\web\AssetBundle;

class VueAssets extends AssetBundle
{
    public $sourcePath = '@common/widgets/vue/assets';
    public $baseUrl = '@web';
    public $css = [
        'css/app.css',
    ];
    public $js = [
        'js/app.js',
        'js/chunk-vendors.js',
    ];
}
?>
<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class TemplateAsset extends AssetBundle
{
    public $sourcePath = '@vendor';
    public $css = [
        'almasaeed2010/adminlte/dist/css/AdminLTE.min.css',
        'almasaeed2010/adminlte/dist/css/skins/_all-skins.min.css',
    ];
    public $js = [
        'almasaeed2010/adminlte/dist/js/app.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        
    ];
}

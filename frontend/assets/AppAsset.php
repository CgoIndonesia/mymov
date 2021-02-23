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
        'css/style.css',
        'css/lazyYT.css',
        '//fonts.googleapis.com/css?family=Open+Sans:400,700',
        'css/isotope.css',
        'css/owl.carousel.css',
        'css/owl.theme.css',
        'css/lightgallery.css',
        'css/justifiedGallery.min.css'
    ];
    public $js = [
        'js/template.js',
        'js/lazyYT.js',
        'js/isotope.min.js',
        'js/jquery.fancybox.pack.js',
        'js/isotope-triger.js',
        'js/SmoothScroll.js',
        'js/owl.carousel.min.js',
        'js/lightgallery.js',
        'js/lg-video.min.js',
        'js/lg-thumbnail.min.js',
        'js/jquery.justifiedGallery.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

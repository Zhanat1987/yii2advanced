<?php

namespace backend\assets;

use yii\web\AssetBundle;
use yii\web\View;

class BootstrapWidgetsAsset extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $js = ['js/bootstrap-widgets.js'];
    public $css = ['css/bootstrap-widgets.css'];
    public $jsOptions = ['position' => View::POS_END];
    public $cssOptions = ['position' => View::POS_END];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/callouts.css',
        'css/scroll-top.css',
        'css/btn-hover.css',
        'css/panels.css',
        'css/dropdownCheckList.css',
        'css/allianceDefault.css',
    ];
    public $js = [
        'js/main.js',
    ];
    public $jsOptions = array(
        // 'position' => \yii\web\View::POS_HEAD
    );
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'app\assets\FontAwesomeAsset',
        // '\rmrevin\yii\fontawesome\AssetBundle'
    ];
}


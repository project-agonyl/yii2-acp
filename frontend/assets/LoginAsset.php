<?php
/**
 * Created by PhpStorm.
 * User: inferno
 * Date: 19-11-2016
 * Time: 16:38
 */

namespace frontend\assets;

use Yii;
use yii\web\AssetBundle;

class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/login.css',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

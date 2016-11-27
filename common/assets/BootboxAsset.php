<?php
/**
 * Created by PhpStorm.
 * User: inferno
 * Date: 27-11-2016
 * Time: 03:30
 */

namespace common\assets;

use Yii;
use yii\web\AssetBundle;

class BootboxAsset extends AssetBundle
{
    public $sourcePath = '@vendor/npm/bootbox';
    public $js = [
        'bootbox.min.js',
    ];
}
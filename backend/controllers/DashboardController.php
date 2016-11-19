<?php
/**
 * Created by PhpStorm.
 * User: inferno
 * Date: 19-11-2016
 * Time: 15:18
 */

namespace backend\controllers;

use Yii;
use common\components\Controller;
use yii\helpers\Url;

class DashboardController extends Controller
{
    public function actionIndex()
    {
        echo 'Logged in as '.Yii::$app->user->id;
        echo '<br>';
        echo '<a href="'.Url::to(['/account/logout']).'">Logout</a>';
    }
}

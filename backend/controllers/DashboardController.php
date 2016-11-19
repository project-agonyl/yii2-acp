<?php
/**
 * Created by PhpStorm.
 * User: inferno
 * Date: 19-11-2016
 * Time: 15:18
 */

namespace backend\controllers;

use backend\models\Dashboard;
use Yii;
use common\components\Controller;

class DashboardController extends Controller
{
    public $layout = '@app/views/layouts/main';

    public function actionIndex()
    {
        $dataModel = new Dashboard();
        return $this->render('index', ['dataModel' => $dataModel]);
    }
}

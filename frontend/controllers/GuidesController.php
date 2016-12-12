<?php
/**
 * Created by PhpStorm.
 * User: inferno
 * Date: 12-12-2016
 * Time: 15:06
 */

namespace frontend\controllers;

use Yii;
use common\components\Controller;

class GuidesController extends Controller
{
    public function actionConversionChart()
    {
        return $this->render('conversionChart');
    }

    public function actionRebirth()
    {
        return $this->render('rebirth');
    }
}

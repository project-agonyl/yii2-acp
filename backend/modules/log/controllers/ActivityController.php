<?php
/**
 * Created by PhpStorm.
 * User: inferno
 * Date: 21-11-2016
 * Time: 00:26
 */

namespace backend\modules\log\controllers;

use backend\modules\log\models\ActivityLogSearch;
use Yii;
use common\components\Controller;

class ActivityController extends Controller
{
    public function actionIndex($admin = '0')
    {
        $searchModel = new ActivityLogSearch([
            'isAdmin' => (bool)$admin
        ]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
    }
}

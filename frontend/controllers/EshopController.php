<?php
/**
 * Created by PhpStorm.
 * User: inferno
 * Date: 06-12-2016
 * Time: 20:11
 */

namespace frontend\controllers;

use frontend\models\EshopItemSearch;
use Yii;
use common\components\Controller;

class EshopController extends Controller
{
    public function actionIndex($category = null)
    {
        $searchModel = new EshopItemSearch(['category' => $category]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
    }
}

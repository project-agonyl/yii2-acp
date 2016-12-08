<?php
/**
 * Created by PhpStorm.
 * User: talview1
 * Date: 8/12/16
 * Time: 9:29 AM
 */

namespace backend\modules\log\controllers;

use backend\modules\log\models\ItemLogSearch;
use Yii;
use common\components\Controller;
use yii\helpers\Url;

class ItemController extends Controller
{
    public function actionIndex()
    {
        Url::remember();
        $searchModel = new ItemLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
    }
}

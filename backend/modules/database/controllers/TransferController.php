<?php
namespace backend\modules\database\controllers;

use backend\modules\database\models\TransferSearch;
use Yii;
use common\components\Controller;
use yii\helpers\Url;

class TransferController extends Controller
{
    public function actionIndex()
    {
        Url::remember();
        $searchModel = new TransferSearch(['scenario' => 'search']);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
    }
}

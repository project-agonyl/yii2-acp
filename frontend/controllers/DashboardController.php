<?php
/**
 * Created by PhpStorm.
 * User: inferno
 * Date: 19-11-2016
 * Time: 15:18
 */

namespace frontend\controllers;

use frontend\models\CharacterSearch;
use Yii;
use common\components\Controller;
use yii\helpers\Url;

class DashboardController extends Controller
{
    public $layout = '@app/views/layouts/main';

    public function actionIndex()
    {
        $characterSearchModel = new CharacterSearch(['account' => Yii::$app->user->id]);
        $characterDataProvider = $characterSearchModel->search([]);
        return $this->render('index', ['characterDataProvider' => $characterDataProvider, 'characterSearchModel' => $characterSearchModel]);
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: inferno
 * Date: 19-11-2016
 * Time: 15:18
 */

namespace frontend\controllers;

use frontend\models\CharacterSearch;
use frontend\models\OnlinePlayerSearch;
use frontend\models\PlayerKillSearch;
use frontend\models\TopCharacterSearch;
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

    public function actionTopPlayers()
    {
        $characterSearchModel = new TopCharacterSearch();
        $characterDataProvider = $characterSearchModel->search([]);
        return $this->render('topPlayers', ['characterDataProvider' => $characterDataProvider, 'characterSearchModel' => $characterSearchModel]);
    }

    public function actionOnlinePlayers()
    {
        $characterSearchModel = new OnlinePlayerSearch();
        $characterDataProvider = $characterSearchModel->search([]);
        return $this->render('onlinePlayers', ['characterDataProvider' => $characterDataProvider, 'characterSearchModel' => $characterSearchModel]);
    }

    public function actionPlayerKills()
    {
        $characterSearchModel = new PlayerKillSearch();
        $characterDataProvider = $characterSearchModel->search([]);
        return $this->render('playerkills', ['characterDataProvider' => $characterDataProvider, 'characterSearchModel' => $characterSearchModel]);
    }
}

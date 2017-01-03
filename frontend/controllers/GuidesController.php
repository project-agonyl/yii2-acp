<?php
/**
 * Created by PhpStorm.
 * User: inferno
 * Date: 12-12-2016
 * Time: 15:06
 */

namespace frontend\controllers;

use common\models\EventPoints;
use frontend\models\MonsterItemSearch;
use Yii;
use common\components\Controller;
use yii\data\ActiveDataProvider;

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

    public function actionRebirthCrafting()
    {
        return $this->render('rebirthCrafting');
    }

    public function actionCashRecharge()
    {
        return $this->render('cashRecharge');
    }

    public function actionItemDrop()
    {
        $searchModel = new MonsterItemSearch(['scenario' => 'search']);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('itemDrop', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
    }

    public function actionTopPumpkinSubmitters()
    {
        $query = EventPoints::find()
            ->where([
                'type' => EventPoints::TYPE_PUMPKIN
            ])
            ->orderBy(['points' => SORT_DESC])
            ->limit(10);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'key' => 'id',
            'pagination' => false,
            'sort' => false
        ]);
        return $this->render('topSubmission', ['dataProvider' => $dataProvider]);
    }
}

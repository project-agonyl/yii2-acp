<?php
namespace backend\modules\database\controllers;

use backend\modules\database\models\CharacterSearch;
use common\models\Charac0;
use Yii;
use common\components\Controller;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

class CharacterController extends Controller
{
    public function actionIndex()
    {
        Url::remember();
        $searchModel = new CharacterSearch(['scenario' => 'search']);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
    }

    public function actionCreate()
    {
        return $this->render('create');
    }

    public function actionUpdate($id)
    {
        return $this->render('update');
    }

    public function actionView($id)
    {
        $model = $this->getCharacterModel($id);
        return $this->render('view', ['model' => $model]);
    }

    private function getCharacterModel($id)
    {
        $model = Charac0::find()
            ->where([
                'c_status' => Charac0::STATUS_ACTIVE,
                'c_id' => $id
            ])
            ->one();
        if ($model == null) {
            throw new NotFoundHttpException('Character not found!');
        }
        return $model;
    }
}

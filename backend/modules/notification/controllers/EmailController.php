<?php
namespace backend\modules\notification\controllers;

use backend\modules\notification\models\NotificationLogSearch;
use common\models\NotificationLog;
use Yii;
use common\components\Controller;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

class EmailController extends Controller
{
    public function actionIndex()
    {
        Url::remember();
        $searchModel = new NotificationLogSearch(['scenario' => 'search']);
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
        $model = $this->getNotificationLogModel($id);
        return $this->render('view', ['model' => $model]);
    }

    private function getNotificationLogModel($id)
    {
        $model = NotificationLog::find()
            ->where([
                'id' => $id
            ])
            ->one();
        if ($model == null) {
            throw new NotFoundHttpException('Character not found!');
        }
        return $model;
    }
}

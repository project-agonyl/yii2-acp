<?php
namespace backend\modules\database\controllers;

use backend\modules\database\models\AccountSearch;
use common\models\Account;
use Yii;
use common\components\Controller;
use yii\web\NotFoundHttpException;

class AccountController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new AccountSearch();
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
        $model = $this->getAccountModel($id);
        return $this->render('view', ['model' => $model]);
    }

    private function getAccountModel($id)
    {
        $model = Account::find()
            ->where([
                'c_id' => $id
            ])
            ->one();
        if ($model == null) {
            throw new NotFoundHttpException('Character not found!');
        }
        return $model;
    }
}

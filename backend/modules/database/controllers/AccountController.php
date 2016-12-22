<?php
namespace backend\modules\database\controllers;

use backend\modules\database\models\AccountSearch;
use backend\modules\database\models\TransferCash;
use backend\modules\database\models\TransferCoin;
use common\models\Account;
use Yii;
use common\components\Controller;
use yii\helpers\Url;
use yii\web\NotAcceptableHttpException;
use yii\web\NotFoundHttpException;

class AccountController extends Controller
{
    public function actionIndex()
    {
        Url::remember();
        $searchModel = new AccountSearch(['scenario' => 'search']);
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

    public function actionTransferCash($id)
    {
        $model = $this->getAccountModel($id);
        if ($model->c_id == Yii::$app->user->id) {
            throw new NotAcceptableHttpException('You cannot transfer wallet cash to your own account');
        }
        $dataModel = new TransferCash([
            'fromAid' => Yii::$app->user->id,
            'toAid' => $model->c_id
        ]);
        if (Yii::$app->request->isPost &&
            $dataModel->load(Yii::$app->request->post()) && $dataModel->save()) {
            Yii::$app->session->setFlash('success', 'Successfully transferred wallet cash');
            return $this->redirect(Url::previous());
        }
        return $this->render('transferCash', ['model' => $dataModel]);
    }

    public function actionTransferCoin($id)
    {
        $model = $this->getAccountModel($id);
        if ($model->c_id == Yii::$app->user->id) {
            throw new NotAcceptableHttpException('You cannot transfer wallet coin to your own account');
        }
        $dataModel = new TransferCoin([
            'fromAid' => Yii::$app->user->id,
            'toAid' => $model->c_id
        ]);
        if (Yii::$app->request->isPost &&
            $dataModel->load(Yii::$app->request->post()) && $dataModel->save()) {
            Yii::$app->session->setFlash('success', 'Successfully transferred wallet coin');
            return $this->redirect(Url::previous());
        }
        return $this->render('transferCoin', ['model' => $dataModel]);
    }

    private function getAccountModel($id)
    {
        $model = Account::find()
            ->where([
                'c_id' => $id
            ])
            ->one();
        if ($model == null) {
            throw new NotFoundHttpException('Account not found!');
        }
        return $model;
    }
}

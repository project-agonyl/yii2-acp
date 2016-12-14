<?php
/**
 * Created by PhpStorm.
 * User: inferno
 * Date: 26-11-2016
 * Time: 14:41
 */

namespace backend\modules\database\controllers;

use backend\modules\database\models\BundleItemSearch;
use backend\modules\database\models\BundleSearch;
use backend\modules\database\models\BundleForm;
use Yii;
use common\components\Controller;
use yii\bootstrap\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\MethodNotAllowedHttpException;
use yii\web\NotFoundHttpException;

class BundleController extends Controller
{
    public function actionIndex()
    {
        Url::remember();
        $searchModel = new BundleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
    }

    public function actionCreate()
    {
        $model = new BundleForm(['scenario' => 'create']);
        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Item was successfully added to e-shop');
            $this->redirect(Url::previous());
        }
        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $model = $this->getBundleModel($id);
        $model->scenario = 'update';
        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Item was successfully updated');
            $this->redirect(Url::previous());
        }
        return $this->render('update', ['model' => $model]);
    }

    public function actionView($id)
    {
        $model = $this->getBundleModel($id);
        $searchModel = new BundleItemSearch(['bundle_id' => $model->id]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('view', ['model' => $model, 'dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
    }

    public function actionAddToBundle($id)
    {
        $model = $this->getBundleModel($id);
        if (Yii::$app->request->isPost) {
            if ($model->add(Yii::$app->request->post('item'), Yii::$app->request->post('quantity'))) {
                return Json::encode(['status' => 'ok', 'msg' => 'Item was successfully added to bundle']);
            }
            return Json::encode(['status' => 'nok', 'msg' => Html::errorSummary($model)]);
        }
        throw new MethodNotAllowedHttpException();
    }

    public function actionRemoveFromBundle($id)
    {
        $model = $this->getBundleModel($id);
        if (Yii::$app->request->isPost) {
            if ($model->remove(Yii::$app->request->post('item'), Yii::$app->request->post('quantity'))) {
                return Json::encode(['status' => 'ok', 'msg' => 'Item was successfully removed from bundle']);
            }
            return Json::encode(['status' => 'nok', 'msg' => Html::errorSummary($model)]);
        }
        throw new MethodNotAllowedHttpException();
    }

    private function getBundleModel($id)
    {
        $model = BundleForm::find()
            ->where([
                'id' => $id,
                'is_deleted' => false
            ])
            ->one();
        if ($model == null) {
            throw new NotFoundHttpException('Bundle not found!');
        }
        return $model;
    }
}

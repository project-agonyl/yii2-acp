<?php
/**
 * Created by PhpStorm.
 * User: inferno
 * Date: 26-11-2016
 * Time: 14:41
 */

namespace backend\modules\admin\controllers;

use backend\modules\admin\models\EshopSearch;
use \backend\modules\admin\models\EshopItem;
use Yii;
use common\components\Controller;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

class EshopController extends Controller
{
    public function actionIndex()
    {
        Url::remember();
        $searchModel = new EshopSearch(['scenario' => 'search']);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
    }

    public function actionCreate()
    {
        $model = new EshopItem(['scenario' => 'create']);
        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Item was successfully added to e-shop');
            $this->redirect(Url::previous());
        }
        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $model = $this->getEshopModel($id);
        $model->scenario = 'update';
        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Item was successfully updated');
            $this->redirect(Url::previous());
        }
        return $this->render('update', ['model' => $model]);
    }

    public function actionView($id)
    {
        $model = $this->getEshopModel($id);
        return $this->render('view', ['model' => $model]);
    }

    private function getEshopModel($id)
    {
        $model = EshopItem::find()
            ->where([
                'id' => $id,
                'is_deleted' => false
            ])
            ->one();
        if ($model == null) {
            throw new NotFoundHttpException('E-shop item not found!');
        }
        return $model;
    }
}

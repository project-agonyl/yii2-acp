<?php
namespace backend\modules\database\controllers;

use backend\modules\database\models\EshopDeliverySearch;
use common\models\EshopOrder;
use common\models\EshopOrderItem;
use Yii;
use common\components\Controller;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

class EshopDeliveryController extends Controller
{
    public function actionIndex()
    {
        Url::remember();
        $searchModel = new EshopDeliverySearch();
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
        $model = $this->getEshopOrderModel($id);
        $query = EshopOrderItem::find()
            ->where([
                'is_deleted' => false,
                'eshop_order_id' => $model->id
            ])
            ->orderBy(['id' => SORT_DESC]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'key' => 'id',
            'pagination' => [
                'pageSize' => 10,
                'validatePage' => false
            ],
            'sort' => false
        ]);
        return $this->render('view', ['model' => $model, 'dataProvider' => $dataProvider]);
    }

    private function getEshopOrderModel($id)
    {
        $model = EshopOrder::find()
            ->where([
                'is_delivered' => true,
                'id' => $id
            ])
            ->one();
        if ($model == null) {
            throw new NotFoundHttpException('Delivery not found!');
        }
        return $model;
    }
}

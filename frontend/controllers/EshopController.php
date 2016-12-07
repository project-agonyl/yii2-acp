<?php
/**
 * Created by PhpStorm.
 * User: inferno
 * Date: 06-12-2016
 * Time: 20:11
 */

namespace frontend\controllers;

use frontend\models\Cart;
use frontend\models\EshopItemSearch;
use Yii;
use common\components\Controller;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\MethodNotAllowedHttpException;

class EshopController extends Controller
{
    public function actionIndex($category = null)
    {
        $searchModel = new EshopItemSearch(['category' => $category]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
    }

    public function actionCart()
    {
        $cart = new Cart(['account' => Yii::$app->user->id]);
        return $this->render('cart', ['cart' => $cart]);
    }
    
    public function actionAddToCart()
    {
        $cart = new Cart(['account' => Yii::$app->user->id]);
        if (Yii::$app->request->isPost) {
            if ($cart->add(Yii::$app->request->post('item'), Yii::$app->request->post('quantity'))) {
                return Json::encode(['status' => 'ok', 'msg' => 'Item was successfully added to cart']);
            }
            return Json::encode(['status' => 'nok', 'msg' => Html::errorSummary($cart)]);
        }
        throw new MethodNotAllowedHttpException();
    }
    
    public function actionRemoveFromCart()
    {
        $cart = new Cart(['account' => Yii::$app->user->id]);
        if (Yii::$app->request->isPost) {
            if ($cart->remove(Yii::$app->request->post('item'), Yii::$app->request->post('quantity'))) {
                return Json::encode(['status' => 'ok', 'msg' => 'Item was successfully removed from cart']);
            }
            return Json::encode(['status' => 'nok', 'msg' => Html::errorSummary($cart)]);
        }
        throw new MethodNotAllowedHttpException();
    }
}

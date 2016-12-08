<?php
/**
 * Created by PhpStorm.
 * User: inferno
 * Date: 06-12-2016
 * Time: 20:11
 */

namespace frontend\controllers;

use common\models\Account;
use common\models\Charloginlog;
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

    public function actionCanBuyUsingCoins()
    {
        $cart = new Cart(['account' => Yii::$app->user->id]);
        if ($cart->isEmpty) {
             return Json::encode(['status' => 'nok', 'msg' => 'Shopping cart is empty!']);
        }
        if ($cart->canBuyUsingCoins) {
            return Json::encode(['status' => 'ok', 'msg' => 'Can buy using Flamez coins']);
        }
        return Json::encode(['status' => 'nok', 'msg' => '<h4>Remove items that are not available for Flamez coins and try again!</h4>']);
    }

    public function actionCanBuyUsingCash()
    {
        $cart = new Cart(['account' => Yii::$app->user->id]);
        if ($cart->isEmpty) {
             return Json::encode(['status' => 'nok', 'msg' => 'Shopping cart is empty!']);
        }
        if ($cart->canBuyUsingCash) {
            return Json::encode(['status' => 'ok', 'msg' => 'Can buy using Flamez cash']);
        }
        return Json::encode(['status' => 'nok', 'msg' => '<h4>Remove items that are not available for Flamez cash and try again!</h4>']);
    }

    public function actionListDeliverableCharacters()
    {
        $model = Account::find()
            ->where(['c_id' => Yii::$app->user->id])
            ->one();
        $characters = $model->deliverableCharacters;
        if (count($characters) != 0) {
            return Json::encode(['status' => 'ok', 'msg' => 'Character list', 'characters' => array_values($characters)]);
        }
        return Json::encode(['status' => 'nok', 'msg' => 'Please keep only Upgrade Jewel in the 1st slot of character inventory to which you want to deliver items!']);
    }

    public function actionDeliverUsingCoins()
    {
        if (Yii::$app->request->isPost) {
            $character = Yii::$app->request->post('character');
            if ($character == null) {
                return Json::encode(['status' => 'nok', 'msg' => 'Please choose a character to deliver items!']);
            }
            $character = trim($character);
            $model = Account::find()
                ->where(['c_id' => Yii::$app->user->id])
                ->one();
            $characters = $model->deliverableCharacters;
            if (!in_array($character, array_values($characters))) {
                return Json::encode(['status' => 'nok', 'msg' => 'Please keep only Upgrade Jewel in the 1st slot of character inventory to which you want to deliver items!']);
            }
            $onlineCount = Charloginlog::find()
            ->where([
                'c_id' => $character
            ])
            ->count();
            if ($onlineCount != 0) {
                return Json::encode(['status' => 'nok', 'msg' => 'Please keep the character OFFLINE!']);
            }
            $cart = new Cart([
                'account' => Yii::$app->user->id,
                'charToDeliver' => $character
            ]);
            if ($cart->deliverUsingCoins()) {
                return Json::encode(['status' => 'ok', 'msg' => 'Items were successfully delivered to '.$character]);
            }
            return Json::encode(['status' => 'nok', 'msg' => Html::errorSummary($cart)]);
        }
        throw new MethodNotAllowedHttpException();
    }

    public function actionDeliverUsingCash()
    {
        if (Yii::$app->request->isPost) {
            $character = Yii::$app->request->post('character');
            if ($character == null) {
                return Json::encode(['status' => 'nok', 'msg' => 'Please choose a character to deliver items!']);
            }
            $character = trim($character);
            $model = Account::find()
                ->where(['c_id' => Yii::$app->user->id])
                ->one();
            $characters = $model->deliverableCharacters;
            if (!in_array($character, array_values($characters))) {
                return Json::encode(['status' => 'nok', 'msg' => 'Please keep only Upgrade Jewel in the 1st slot of character inventory to which you want to deliver items!']);
            }
            $onlineCount = Charloginlog::find()
            ->where([
                'c_id' => $character
            ])
            ->count();
            if ($onlineCount != 0) {
                return Json::encode(['status' => 'nok', 'msg' => 'Please keep the character OFFLINE!']);
            }
            $cart = new Cart([
                'account' => Yii::$app->user->id,
                'charToDeliver' => $character
            ]);
            if ($cart->deliverUsingCash()) {
                return Json::encode(['status' => 'ok', 'msg' => 'Items were successfully delivered to '.$character]);
            }
            return Json::encode(['status' => 'nok', 'msg' => Html::errorSummary($cart)]);
        }
        throw new MethodNotAllowedHttpException();
    }
}

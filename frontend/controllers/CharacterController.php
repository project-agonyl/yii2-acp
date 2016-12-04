<?php
/**
 * Created by PhpStorm.
 * User: inferno
 * Date: 27-11-2016
 * Time: 16:08
 */

namespace frontend\controllers;

use common\models\ActivityLog;
use common\models\Charac0;
use common\models\Charloginlog;
use Yii;
use common\components\Controller;
use yii\bootstrap\Html;
use yii\helpers\Json;
use yii\web\MethodNotAllowedHttpException;
use yii\web\NotAcceptableHttpException;
use yii\web\NotFoundHttpException;

class CharacterController extends Controller
{
    public function actionOfflineTeleport($id)
    {
        $characterModel = $this->loadCharacterModel($id);
        if (Yii::$app->request->isPost) {
            $characterModel->c_headerb = Charac0::TEMOZ_LOCATION;
            if (!$characterModel->save()) {
                return Json::encode(['status' => 'nok', 'msg' => Html::errorSummary($characterModel)]);
            }
            ActivityLog::addEntry(
                ActivityLog::EVENT_OFFLINE_TELEPORT,
                Yii::$app->user->id,
                [
                    'character' => $characterModel->c_id,
                    'location' => Charac0::TEMOZ_LOCATION
                ]
            );
            return Json::encode(['status' => 'ok', 'msg' => 'Character was successfully teleported to temoz.']);
        }
        throw new MethodNotAllowedHttpException();
    }

    public function actionView($id)
    {
        $model = Charac0::find()
            ->where([
                'c_id' => $id,
                'c_sheadera' => Yii::$app->user->id,
                'c_status' => Charac0::STATUS_ACTIVE
            ])
            ->one();
        if ($model == null) {
            throw new NotFoundHttpException('Character either not found in your account or deleted');
        }
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('view', ['model' => $model]);
        }
        return $this->render('view', ['model' => $model]);
    }

    public function actionBeginnersGift($id)
    {
        $characterModel = $this->loadCharacterModel($id);
        if (Yii::$app->request->isPost) {
            if ($characterModel->set_gift != 0) {
                return Json::encode(['status' => 'nok', 'msg' => 'This character has already taken beginner\'s gift.']);
            }
            $oldMBody = $characterModel->m_body;
            $mBodyArray = explode('\_1', $characterModel->m_body);
            $PETACT = explode("=", $mBodyArray[18]);
            switch($characterModel->c_sheaderb) {
                case "0":
                    $PETACT[1] = "1012;76684069;4152360961;4294160367";
                    break;
                case "1":
                    $PETACT[1] = "1013;76290853;4152360961;4294160495";
                    break;
                case "2":
                    $PETACT[1] = "1014;75897637;4152360961;4294160379";
                    break;
                case "3":
                    $PETACT[1] = "1015;76028709;4152360961;4294160367";
                    break;
            }
            $mBodyArray[18] = implode('=', $PETACT);
            $characterModel->m_body = implode('\_1', $mBodyArray);
            $characterModel->set_gift = 1;
            if (!$characterModel->save()) {
                return Json::encode(['status' => 'nok', 'msg' => Html::errorSummary($characterModel)]);
            }
            ActivityLog::addEntry(
                ActivityLog::EVENT_TAKE_BEGINNERS_GIFT,
                Yii::$app->user->id,
                [
                    'character' => $characterModel->c_id,
                    'old_m_body' => $oldMBody,
                    'new_m_body' => $characterModel->m_body
                ]
            );
            return Json::encode(['status' => 'ok', 'msg' => 'Gift was successfully delivered.']);
        }
        throw new MethodNotAllowedHttpException();
    }

    public function actionViewRebirthRequirements($id)
    {
        $characterModel = $this->loadCharacterModel($id);
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('requirementView', ['model' => $characterModel]);
        }
        return $this->render('requirementView', ['model' => $characterModel]);
    }

    public function actionTakeRebirth($id)
    {
        $characterModel = $this->loadCharacterModel($id);
        if (Yii::$app->request->isPost) {
            if (!$characterModel->takeRebirth()) {
                return Json::encode(['status' => 'nok', 'msg' => Html::errorSummary($characterModel)]);
            }
            return Json::encode(['status' => 'ok', 'msg' => 'Rebirth was successfully taken.']);
        }
        throw new MethodNotAllowedHttpException();
    }

    private function loadCharacterModel($id)
    {
        $model = Charac0::find()
            ->where([
                'c_id' => $id,
                'c_sheadera' => Yii::$app->user->id,
                'c_status' => Charac0::STATUS_ACTIVE
            ])
            ->one();
        if ($model == null) {
            throw new NotFoundHttpException('Character either not found in your account or deleted');
        }
        $onlineCount = Charloginlog::find()
            ->where([
                'c_id' => $model->c_id
            ])
            ->count();
        if ($onlineCount != 0) {
            throw new NotAcceptableHttpException('Character is online to do this operation');
        }
        return $model;
    }
}

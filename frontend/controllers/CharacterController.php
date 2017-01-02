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
use common\models\CharacterSpree;
use common\models\Charloginlog;
use common\models\DailyQuest;
use Yii;
use common\components\Controller;
use yii\bootstrap\Html;
use yii\db\Query;
use yii\helpers\ArrayHelper;
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

    public function actionQuestWarning($id, $type)
    {
        $characterModel = $this->loadCharacterModel($id);
        if ($type == 2) {
            if ($characterModel->c_sheaderc < 100) {
                return Json::encode(['status' => 'ok', 'msg' => 'Character level is below 100 hence may not be able to complete quest. Are you sure?']);
            }
        }
        if ($type == 1) {
            if (!$characterModel->canTakeDailyQuest && $characterModel->hasNonSubmittedDailyQuest) {
                return Json::encode(['status' => 'ok', 'msg' => 'Character might have pending/non-submitted daily quest. Are you sure?']);
            }
            if ($characterModel->hasNonSubmittedDailyQuest) {
                return Json::encode(['status' => 'ok', 'msg' => 'Character might have previously non-submitted daily quest. Are you sure?']);
            }
        }
        return Json::encode(['status' => 'ok', 'msg' => 'This will replace any current QUEST you have. Are you sure?']);
    }

    public function actionTakeQuest($id)
    {
        $characterModel = $this->loadCharacterModel($id);
        if (Yii::$app->request->isPost) {
            $type = Yii::$app->request->post('type', 1);
            if ($type == 1 && $characterModel->c_sheaderc < 160) {
                return Json::encode(['status' => 'nok', 'msg' => 'Character has to be 160 level to take quest']);
            }
            if ($type == 2 && !$characterModel->canTakeDailyQuest) {
                return Json::encode(['status' => 'nok', 'msg' => 'Daily quest can only be taken once per day per character']);
            }
            switch ((int)$type) {
                case 2:
                    $questId = 2463;
                    break;
                default:
                    switch ((int)$characterModel->c_sheaderb) {
                        case 1:
                            $questId = 709;
                            break;
                        case 2:
                            $questId = 432;
                            break;
                        case 3:
                            $questId = 383;
                            break;
                        default:
                            $questId = 398;
                            break;
                    }
                    break;
            }
            $mBodyArray = explode('\_1', $characterModel->m_body);
            $CQUEST = explode("=", $mBodyArray[$characterModel->currentQuestIndex]);
            $CQUEST[1] = "$questId;0;0;0;0;0;0;0;1";
            $mBodyArray[$characterModel->currentQuestIndex] = implode('=', $CQUEST);
            $characterModel->m_body = implode('\_1', $mBodyArray);
            if (!$characterModel->save()) {
                return Json::encode(['status' => 'nok', 'msg' => Html::errorSummary($characterModel)]);
            }
            if ($type == 2) {
                $dq = new DailyQuest([
                    'character' => $characterModel->c_id,
                    'taken_at' => date('Y-m-d', time())
                ]);
                $dq->save();
            }
            if ($type == 1) {
                $logType = ActivityLog::EVENT_TAKE_QUEST;
            } else {
                $logType = ActivityLog::EVENT_TAKE_DAILY_QUEST;
            }
            ActivityLog::addEntry(
                $logType,
                Yii::$app->user->id,
                [
                    'character' => $characterModel->c_id,
                    'quest_id' => $questId
                ]
            );
            return Json::encode(['status' => 'ok', 'msg' => 'Quest was successfully assigned to your character.']);
        }
        throw new MethodNotAllowedHttpException();
    }

    public function actionSubmitQuest($id)
    {
        $characterModel = $this->loadCharacterModel($id);
        if (Yii::$app->request->isPost) {
            $type = Yii::$app->request->post('type', 2);
            if ($type == 2) {
                if (!$characterModel->saveDailyQuestSubmission()) {
                    return Json::encode(['status' => 'nok', 'msg' => Html::errorSummary($characterModel)]);
                }
                return Json::encode(['status' => 'ok', 'msg' => 'Quest was submitted successfully.']);
            } else {
                return Json::encode(['status' => 'nok', 'msg' => 'Invalid quest type.']);
            }
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
            $PETACT = explode("=", $mBodyArray[$characterModel->currentShueIndex]);
            $WEAR = explode("=", $mBodyArray[$characterModel->wearIndex]);
            $SKILL = explode("=", $mBodyArray[$characterModel->skillIndex]);
            switch($characterModel->c_sheaderb) {
                case "0":
                    $WEAR[1] = "1030;2154;4294967295;3403;3105;4294967295;36151;4129;4294967295;3393;5153;4294967295;3423;6177;4294967295;36181;7217;4294967295";
                    $SKILL[1] = "4294967124;0;0";
                    $PETACT[1] = "1012;76684069;4152360961;4294160367";
                    break;
                case "1":
                    $WEAR[1] = "3563;481;4294967295;1090;1450;4294967295;3533;3105;4294967295;3513;4129;4294967295;3523;21537;4294967295;3553;6177;4294967295;3543;7201;4294967295";
                    $SKILL[1] = "1065353198;0;0";
                    $PETACT[1] = "1013;76290853;4152360961;4294160495";
                    break;
                case "2":
                    $WEAR[1] = "2106;2730;4294967295;3578;3105;4294967295;36336;4129;4294967295;36341;5153;4294967295;3588;6177;4294967295;3583;30415905;4294967295";
                    $SKILL[1] = "4290723710;2147483648;0";
                    $PETACT[1] = "1014;75897637;4152360961;4294160379";
                    break;
                case "3":
                    $WEAR[1] = "17518;100;4294967295;1128;1633;4294967295;36451;3105;4294967295;3663;4129;4294967295;3673;70689;4294967295;3703;6177;4294967295;3693;1073749025;4294967295";
                    $SKILL[1] = "131070;0;0";
                    $PETACT[1] = "1015;76028709;4152360961;4294160367";
                    break;
            }
            $mBodyArray[$characterModel->wearIndex] = implode('=', $WEAR);
            $mBodyArray[$characterModel->skillIndex] = implode('=', $SKILL);
            $mBodyArray[$characterModel->currentShueIndex] = implode('=', $PETACT);
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

    public function actionResetStats($id)
    {
        $characterModel = $this->loadCharacterModel($id);
        if (Yii::$app->request->isPost) {
            if (!$characterModel->resetStats(Yii::$app->request->post('type', 'coin'))) {
                return Json::encode(['status' => 'nok', 'msg' => Html::errorSummary($characterModel)]);
            }
            return Json::encode(['status' => 'ok', 'msg' => 'Stats were reset successfully.']);
        }
        throw new MethodNotAllowedHttpException();
    }

    public function actionSubmitItem($id)
    {
        $characterModel = $this->loadCharacterModel($id);
        if (Yii::$app->request->isPost) {
            if (!$characterModel->submitEventItem(Yii::$app->request->post('type', 1))) {
                return Json::encode(['status' => 'nok', 'msg' => Html::errorSummary($characterModel)]);
            }
            return Json::encode(['status' => 'ok', 'msg' => 'Items were submitted successfully.']);
        }
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

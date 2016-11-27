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

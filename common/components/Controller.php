<?php

namespace common\components;

use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors[ 'access' ] = [
            'class' => AccessControl::className(),
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ],
        ];
        return $behaviors;
    }

    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            date_default_timezone_set("Asia/Calcutta");
            if (ArrayHelper::getValue(Yii::$app->params, 'maintenance', false) &&
                !in_array(trim(Yii::$app->user->id), ArrayHelper::getValue(Yii::$app->params, 'admins', []))) {
                echo 'ACP under maintenance. Please try after some time!';
            }
            return true;
        }
        return false;
    }
}

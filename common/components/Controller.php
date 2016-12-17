<?php

namespace common\components;

use Yii;
use yii\filters\AccessControl;
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
            return true;
        }
        return false;
    }
}

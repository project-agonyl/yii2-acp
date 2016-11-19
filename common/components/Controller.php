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
}

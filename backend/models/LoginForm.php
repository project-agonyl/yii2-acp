<?php
/**
 * Created by PhpStorm.
 * User: inferno
 * Date: 19-11-2016
 * Time: 15:32
 */
namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

class LoginForm extends \common\models\virtual\LoginForm
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(
            parent::rules(),
            [
                ['username', 'validateAdmin']
            ]
        );
    }

    /**
     * Validates admin username.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateAdmin($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if (!$this->$attribute ||
                !in_array($this->$attribute, ArrayHelper::getValue(Yii::$app->params, 'admins', []))) {
                $this->addError($attribute, 'You are not authorised to use admin panel');
            }
        }
    }
}

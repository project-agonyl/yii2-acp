<?php

namespace common\models;

use Yii;
use \common\models\base\NotificationLog as BaseNotificationLog;
use yii\base\View;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "notification_log".
 */
class NotificationLog extends BaseNotificationLog
{
    const TYPE_ACCOUNT_ACTIVATION = 1;

    const STATUS_PENDING = 0;
    const STATUS_SENT = 1;
    const STATUS_ERROR = 999;

    public function behaviors()
    {
        return [];
    }

    public function rules()
    {
        return ArrayHelper::merge(
             parent::rules(),
             [
                  # custom validation rules
             ]
        );
    }

    public static function getTypeList()
    {
        return [
            self::TYPE_ACCOUNT_ACTIVATION => 'Account activation mail'
        ];
    }

    public static function sendMail($type, $toAddress, array $params = [], $fromAddress = 'no-reply@a3-flamez.com')
    {
        if (!in_array($type, array_keys(self::getTypeList())) ||
            !filter_var($fromAddress, FILTER_VALIDATE_EMAIL) ||
            !filter_var($toAddress, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        $subjectTemplate = __DIR__.'/../mail/templates/subject/'.$type.'.php';
        $bodyTemplate = __DIR__.'/../mail/templates/body/'.$type.'.php';
        if (!file_exists($subjectTemplate) || !file_exists($bodyTemplate)) {
            Yii::error('Template '.$type.' not found!');
            return false;
        }
        $view = new View();
        try {
            $subject = $view->renderPhpFile($subjectTemplate, $params);
            $body = $view->renderPhpFile($bodyTemplate, $params);
            $log = new NotificationLog();
            $log->from_address = $fromAddress;
            $log->to_address = $toAddress;
            $log->subject = $subject;
            $log->body = $body;
            $log->type = $type;
            return $log->save();
        } catch (\Exception $e) {
            Yii::error($e->getMessage());
            return false;
        }
    }
}

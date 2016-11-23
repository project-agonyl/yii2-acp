<?php

namespace common\models;

use SendGrid\Content;
use SendGrid\Email;
use SendGrid\Mail;
use Yii;
use \common\models\base\NotificationLog as BaseNotificationLog;
use yii\base\View;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * This is the model class for table "notification_log".
 */
class NotificationLog extends BaseNotificationLog
{
    const TYPE_ACCOUNT_ACTIVATION = 1;
    const TYPE_ACCOUNT_ACTIVATED = 2;
    const TYPE_FORGOT_PASSWORD = 3;
    const TYPE_UPDATED_PASSWORD = 4;
    const TYPE_CHANGE_EMAIL_REQUEST = 5;
    const TYPE_UPDATED_EMAIL = 6;

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
            self::TYPE_ACCOUNT_ACTIVATION => 'Account activation mail',
            self::TYPE_ACCOUNT_ACTIVATED => 'Account activated',
            self::TYPE_FORGOT_PASSWORD => 'Forgot password',
            self::TYPE_UPDATED_PASSWORD => 'Updated password',
            self::TYPE_CHANGE_EMAIL_REQUEST => 'Change email request',
            self::TYPE_UPDATED_EMAIL => 'Updated email'
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
            if (!$log->save()) {
                Yii::error(Json::encode($log->errors));
                return false;
            }
            $from = new Email(null, $fromAddress);
            $to = new Email(null, $toAddress);
            $content = new Content("text/html", $body);
            $mail = new Mail($from, $subject, $to, $content);
            $sg = new \SendGrid(ArrayHelper::getValue(Yii::$app->params, 'sendgrid.apikey', ''));
            $response = $sg->client->mail()->send()->post($mail);
            Yii::info('Notification '.$log->id.' response status code is '.$response->statusCode());
            Yii::info('Notification '.$log->id.' response headers are '.$response->headers());
            Yii::info('Notification '.$log->id.' response body is '.$response->body());
            return true;
        } catch (\Exception $e) {
            Yii::error($e->getMessage());
            return false;
        }
    }
}

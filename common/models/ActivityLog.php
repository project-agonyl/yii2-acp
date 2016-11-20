<?php

namespace common\models;

use Sinergi\BrowserDetector\Os;
use Yii;
use \common\models\base\ActivityLog as BaseActivityLog;
use Sinergi\BrowserDetector\Browser;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * This is the model class for table "activity_log".
 */
class ActivityLog extends BaseActivityLog
{
    const EVENT_TRANSFER_CASH = 1;
    const EVENT_ACP_LOGIN = 2;
    const EVENT_ACP_LOGOUT = 3;
    const EVENT_ADMIN_PANEL_LOGIN = 4;
    const EVENT_ADMIN_PANEL_LOGOUT = 5;
    const EVENT_UNKNOWN = 999;

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                [
                    'class' => TimestampBehavior::className(),
                    'createdAtAttribute' => 'created_at',
                    'updatedAtAttribute' => 'updated_at',
                    'value' => new Expression('CURRENT_TIMESTAMP'),
                ]
            ]
        );
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

    public static function getEventList()
    {
        return [
            self::EVENT_TRANSFER_CASH => 'Wallet cash transfer',
            self::EVENT_ACP_LOGIN => 'ACP login',
            self::EVENT_ACP_LOGOUT => 'ACP logout',
            self::EVENT_ADMIN_PANEL_LOGIN => 'Admin panel login',
            self::EVENT_ADMIN_PANEL_LOGOUT => 'Admin panel logout',
            self::EVENT_UNKNOWN => 'Unknown event'
        ];
    }

    public static function addEntry($event, $account, $data = [], $description = '')
    {
        $browser = new Browser();
        $os = new Os();
        $event = new ActivityLog([
            'event' => (in_array($event, array_keys(self::getEventList())))?$event:self::EVENT_UNKNOWN,
            'account' => $account,
            'data' => is_array($data)?Json::encode($data):$data,
            'description' => $description,
            'ip_address' => Yii::$app->request->userIP,
            'browser' => $browser->getName().' '.$browser->getVersion(),
            'operating_system' => $os->getName()
        ]);
        return $event->save();
    }
}

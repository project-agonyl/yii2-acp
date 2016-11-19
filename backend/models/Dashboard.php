<?php
/**
 * Created by PhpStorm.
 * User: inferno
 * Date: 19-11-2016
 * Time: 19:58
 */

namespace backend\models;

use common\models\Account;
use common\models\Charac0;
use Yii;
use yii\base\Model;

class Dashboard extends Model
{
    public $aid;

    public function getAccountCount()
    {
        return Account::find()
            ->count();
    }

    public function getActiveCharacterCount()
    {
        return $this->getCharacterCount(Charac0::STATUS_ACTIVE);
    }

    public function getCharacterCount($status)
    {
        return Charac0::find()
            ->where(['c_status' => $status])
            ->count();
    }

    public function getWalletCash()
    {
        $account = Account::find()
            ->where(['c_id' => $this->aid])
            ->one();
        return $account->cash;
    }
}

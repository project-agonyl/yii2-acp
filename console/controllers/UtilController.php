<?php
/**
 * Created by PhpStorm.
 * User: talview1
 * Date: 6/12/16
 * Time: 11:40 AM
 */

namespace console\controllers;

use common\models\Account;
use common\models\ActivityLog;
use common\models\ConnectOldAccount;
use common\models\NotificationLog;
use common\models\OldAccount;
use common\models\Wallet;
use Yii;
use yii\console\Controller;
use yii\helpers\Console;

class UtilController extends Controller
{
    public $old_account;
    public $current_account;

    /**
     * @inheritdoc
     */
    public function options($id)
    {
        switch ($id) {
            case 'process-coin-transfer':
                $options = ['old_account', 'current_account'];
                break;
            default:
                $options = [];
                break;
        }
        return array_merge(parent::options($id), $options);
    }

    public function actionProcessCoinTransfer()
    {
        if ($this->old_account == null) {
            $this->old_account =  Console::prompt('Please input old account username:', ['required' => true]);
        }
        $oldAccountModel = OldAccount::find()
            ->where([
                'c_id' => $this->old_account,
                'c_status' => OldAccount::STATUS_ACTIVE
            ])
            ->one();
        if ($oldAccountModel == null) {
            Console::error('Old account is either invalid or status is not active');
            return;
        }
        if ($this->current_account == null) {
            $this->current_account =  Console::prompt('Please input current account username:', ['required' => true]);
        }
        $currentAccountModel = Account::find()
            ->where([
                'c_id' => $this->current_account,
                'c_status' => Account::STATUS_ACTIVE
            ])
            ->one();
        if ($currentAccountModel == null) {
            Console::error('Old account is either invalid or status is not active');
            return;
        }
        $connectModel = ConnectOldAccount::find()
            ->where([
                'current_account' => $this->current_account,
                'old_account' => $this->old_account
            ])
            ->one();
        if ($connectModel == null) {
            Console::error('This pair of accounts transfer request has not been raised');
            return;
        }
        if ($connectModel->status == ConnectOldAccount::STATUS_CLOSED) {
            Console::error('This pair of accounts transfer request has been closed by an admin');
            return;
        }
        if ($connectModel->status == ConnectOldAccount::STATUS_DECLINED) {
            Console::error('This pair of accounts transfer request has been declined by an admin');
            return;
        }
        if ($connectModel->status == ConnectOldAccount::STATUS_PENDING) {
            Console::error('This pair of accounts transfer request has not been verified by the old account holder');
            return;
        }
        if ($connectModel->status == ConnectOldAccount::STATUS_RESOLVED) {
            Console::error('This pair of accounts transfer request has already been resolved by an admin');
            Console::error('Coins transferred: '.$connectModel->coin_given);
            return;
        }
        $oldAccountValue = $oldAccountModel->totalItemValue;
        $confirm = Console::confirm('Old account value seems to be '.$oldAccountValue.
            '. Are you sure you want to continue resolving the request?');
        if (!$confirm) {
            return;
        }
        $connectModel->coin_given = $oldAccountValue;
        $connectModel->status = ConnectOldAccount::STATUS_RESOLVED;
        if (!$connectModel->save()) {
            Console::error(print_r($connectModel->errors, true));
        } else {
            $toWallet = $currentAccountModel->wallet;
            if ($toWallet == null) {
                $toWallet = new Wallet();
                $toWallet->account = $currentAccountModel->c_id;
                $toWallet->coin = $oldAccountValue;
            } else {
                $toWallet->coin += $oldAccountValue;
            }
            if (!$toWallet->save()) {
                Console::error(print_r($toWallet->errors, true));
            } else {
                ActivityLog::addEntry(
                    ActivityLog::EVENT_OLD_ACCOUNT_COIN_TRANSFER,
                    'Merlano',
                    [
                        'old_account' => trim($oldAccountModel->c_id),
                        'current_account' => trim($currentAccountModel->c_id),
                        'amount' => $oldAccountValue
                    ],
                    'Merlano transferred ' . $oldAccountValue . ' coin to ' . trim($oldAccountModel->c_id)
                );
                NotificationLog::sendMail(
                    NotificationLog::TYPE_TRANSFER_OLD_ACCOUNT_RESOLVED,
                    $currentAccountModel->c_headerb,
                    [
                        'old_account' => $this->old_account,
                        'current_account' => $this->current_account,
                        'coins' => $oldAccountValue
                    ]
                );
                Console::output('The request was successfully resolved and the player was notified');
            }
        }
    }
}

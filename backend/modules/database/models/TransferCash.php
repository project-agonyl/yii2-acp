<?php
/**
 * Created by PhpStorm.
 * User: inferno
 * Date: 20-11-2016
 * Time: 19:32
 */

namespace backend\modules\database\models;

use common\models\Account;
use common\models\ActivityLog;
use common\models\Wallet;
use Yii;
use yii\base\Model;
use yii\web\BadRequestHttpException;

class TransferCash extends Model
{
    public $fromAid;
    public $toAid;
    /**
     * @var \common\models\Account
     */
    public $fromModel;
    /**
     * @var \common\models\Account
     */
    public $toModel;
    public $toTransfer;

    public function init()
    {
        if (!$this->fromAid || !$this->toAid) {
            throw new BadRequestHttpException('Please provide both from and to accounts');
        }
        $this->fromModel = Account::find()
            ->where([
                'c_id' => $this->fromAid
            ])
            ->one();
        if ($this->fromModel == null) {
            throw new BadRequestHttpException('Invalid from account');
        }
        $this->toModel = Account::find()
            ->where([
                'c_id' => $this->toAid
            ])
            ->one();
        if ($this->toModel == null) {
            throw new BadRequestHttpException('Invalid to account');
        }
    }

    public function rules()
    {
        return [
            [['toTransfer'], 'safe'],
            [['toTransfer'], 'required', 'message' => 'Please enter amount to be transferred'],
            [
                ['toTransfer'],
                'number',
                'min' => 1,
                'max' => $this->fromModel->cash,
                'tooSmall' => 'Transfer amount cannot be less than 1',
                'tooBig' => 'Transfer amount cannot exceed the amount of cash in your account'
            ]
        ];
    }

    public function save()
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            if ($this->validate()) {
                $fromWallet = $this->fromModel->wallet;
                $fromWallet->cash -= $this->toTransfer;
                if (!$fromWallet->save()) {
                    $this->addErrors($fromWallet->errors);
                    $transaction->rollBack();
                    return false;
                }
                $toWallet = $this->toModel->wallet;
                if ($toWallet == null) {
                    $toWallet = new Wallet();
                    $toWallet->account = $this->toModel->c_id;
                    $toWallet->cash = $this->toTransfer;
                } else {
                    $toWallet->cash += $this->toTransfer;
                }
                if (!$toWallet->save()) {
                    $this->addErrors($toWallet->errors);
                    $transaction->rollBack();
                    return false;
                }
                $transaction->commit();
                ActivityLog::addEntry(
                    ActivityLog::EVENT_TRANSFER_CASH,
                    $this->fromModel->c_id,
                    [
                        'from_account' => trim($this->fromModel->c_id),
                        'to_account' => trim($this->toModel->c_id),
                        'amount' => $this->toTransfer
                    ],
                    trim($this->fromModel->c_id).' transferred '.$this->toTransfer.' cash to '.trim($this->toModel->c_id)
                );
                return true;
            }
            $transaction->rollBack();
            return false;
        } catch (\Exception $e) {
            $transaction->rollBack();
            $this->addError('toTransfer', $e->getMessage());
            return false;
        }
    }
}

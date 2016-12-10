<?php
/**
 * Created by PhpStorm.
 * User: inferno
 * Date: 10-12-2016
 * Time: 15:24
 */

namespace frontend\models;

use Yii;
use yii\base\Model;

class UpdatePassword extends Model
{
    public $account;
    public $oldPassword;
    public $newPassword;
    public $repeatPassword;
}

<?php

/* @var $this yii\web\View
 * @var $dataModel backend\models\Dashboard
 */

$this->title = 'Admin Dashboard';
?>
<div class="row">
    <div class="col-sm-12">
        <p class="lead">Admin Panel</p>
        <p class="text-danger">With great power comes great responsibility. Use it carefully and enjoy!</p>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <h3>Your Account</h3>
        <table class="table table-bordered">
            <tbody>
            <tr>
                <th>Wallet Cash</th>
                <td>0</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="col-sm-6">
        <h3>Server Stats</h3>
        <table class="table table-bordered">
            <tbody>
            <tr>
                <th>No. of Accounts</th>
                <td><?= $dataModel->accountCount; ?></td>
            </tr>
            <tr>
                <th>No. of Active Characters</th>
                <td><?= $dataModel->activeCharacterCount; ?></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
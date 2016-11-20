<?php

/* @var $this yii\web\View
 * @var $model common\models\Charac0
 */
use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

$this->title = $model->c_id.' Details';
?>
<h1>Account Details</h1>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'name' => [
            'attribute' => 'c_id',
            'label' => 'Name'
        ],
        'email' => [
            'attribute' => 'c_headerb',
            'label' => 'E-mail'
        ],
        'wallet_cash' => [
            'attribute' => 'cash',
            'label' => 'Wallet Cash'
        ],
        'wallet_coins' => [
            'attribute' => 'coin',
            'label' => 'Coins'
        ],
        'created' => [
            'attribute' => 'd_cdate',
            'label' => 'Created',
            'format' => 'datetime'
        ],
        'updated' => [
            'attribute' => 'd_udate',
            'label' => 'Last Updated',
            'format' => 'datetime'
        ],
    ],
]); ?>
<?= Html::a('Back', Url::to(['/database/account'], ['class' => 'btn btn-info']));?>

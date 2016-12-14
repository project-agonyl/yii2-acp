<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use kartik\icons\Icon;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body data-controller="<?= \Yii::$app->controller->id ?>"  data-action="<?= \Yii::$app->controller->action->id ;?>"
      data-module="<?= \Yii::$app->controller->module->id ;?>">
<?php $this->beginBody() ?>
<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => ArrayHelper::getValue(\Yii::$app->params, 'server-name', 'A3').' Admin Panel',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => Icon::show('home').'Home', 'url' => ['/']],
        [
            'label' => Icon::show('database').'Database',
            'items' => [
                ['label' => Icon::show('users').'Account', 'url' => ['/database/account']],
                ['label' => Icon::show('user').'Character', 'url' => ['/database/character']],
                ['label' => Icon::show('exchange').'Transfer', 'url' => ['/database/transfer']],
                ['label' => Icon::show('shopping-cart').'E-Shop Delivery', 'url' => ['/database/eshop-delivery']],
            ]
        ],
        [
            'label' => Icon::show('list').'Logs',
            'items' => [
                ['label' => Icon::show('list-alt').'Admin Accounts', 'url' => ['/log/activity?admin=1']],
                ['label' => Icon::show('list-ul').'Normal Accounts', 'url' => ['/log/activity']]
            ]
        ],
        [
            'label' => Icon::show('gear').'Admin',
            'items' => [
                ['label' => Icon::show('shopping-cart').'E-Shop', 'url' => ['/admin/eshop']],
                ['label' => Icon::show('shopping-basket').'E-shop Bundle', 'url' => ['/database/bundle']]
            ]
        ],
        [
            'label' => Icon::show('commenting').'Notifications',
            'items' => [
                ['label' => Icon::show('envelope').'E-mail', 'url' => ['/notification/email']]
            ]
        ],
        ['label' => Icon::show('sign-out').'Logout (' . trim(Yii::$app->user->id) . ')', 'url' => ['/account/logout']]
    ];
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
    <div class="container">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>
<footer class="footer">
    <div class="container">
        <center><p class="muted credit">&copy; <?= ArrayHelper::getValue(\Yii::$app->params, 'server-name', 'A3'); ?>&nbsp;<?= date('Y') ?></p></center>
    </div>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

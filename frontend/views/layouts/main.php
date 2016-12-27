<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\models\AccountInfo;
use frontend\assets\AppAsset;
use frontend\models\EshopItemSearch;
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
    <link rel="stylesheet" href="<?= AccountInfo::getThemeCssUrl(Yii::$app->session->get('theme', 'default'));?>">
</head>
<body data-controller="<?= \Yii::$app->controller->id ?>"  data-action="<?= \Yii::$app->controller->action->id ;?>"
      data-module="<?= \Yii::$app->controller->module->id ;?>">
<?php $this->beginBody() ?>
<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => ArrayHelper::getValue(\Yii::$app->params, 'server-name', 'A3').' Account Control Panel',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => Icon::show('home').'Home', 'url' => ['/dashboard']],
        [
            'label' => Icon::show('gear').'Services',
            'items' => [
                ['label' => Icon::show('user').'Account Details', 'url' => ['/services/account-details']],
                ['label' => Icon::show('users').'Old Account Transfer', 'url' => ['/services/old-account-transfer']],
                ['label' => Icon::show('key').'Update Password', 'url' => ['/services/update-password']],
                ['label' => Icon::show('shopping-cart').'My E-shop Deliveries', 'url' => ['/services/eshop-deliveries']]
            ]
        ],
        ['label' => Icon::show('shopping-basket').'E-Shop', 'url' => ['/eshop']],
        [
            'label' => Icon::show('book').'Guides',
            'items' => [
                ['label' => Icon::show('money').'Cash Recharge', 'url' => ['/guides/cash-recharge']],
                ['label' => Icon::show('exchange').'Conversion Chart', 'url' => ['/guides/conversion-chart']],
                ['label' => Icon::show('forward').'Rebirth', 'url' => ['/guides/rebirth']],
                ['label' => Icon::show('industry').'Rebirth Crafting', 'url' => ['/guides/rebirth-crafting']]
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

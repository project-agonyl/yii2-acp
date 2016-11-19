<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
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
        ['label' => 'Home', 'url' => ['/']],
        [
            'label' => 'Character',
            'items' => [
                ['label' => 'Character Details', 'url' => ['/character/details']],
                ['label' => 'Add Credits', 'url' => ['/character/add-credits']],
                ['label' => 'Add Items', 'url' => ['/character/add-items']]
            ]
        ],
        ['label' => 'Logout (' . trim(Yii::$app->user->id) . ')', 'url' => ['/account/logout']]
    ];
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
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

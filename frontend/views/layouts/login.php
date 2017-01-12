<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\LoginAsset;
use yii\helpers\Html;
use common\widgets\Alert;

LoginAsset::register($this);
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
<div class="container">
    <?= Alert::widget() ?>
    <?= $content ?>
</div>
<footer class="footer">
    <div class="container">
        <center><p class="muted credit">&copy; <?= \yii\helpers\ArrayHelper::getValue(\Yii::$app->params, 'server-name', 'A3'); ?>&nbsp;<?= date('Y') ?></p></center>
    </div>
</footer>
<?php $this->endBody() ?>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-27039494-1', 'auto');
    ga('send', 'pageview');
</script>
</body>
</html>
<?php $this->endPage() ?>


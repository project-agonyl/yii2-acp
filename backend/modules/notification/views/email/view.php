<?php

/* @var $this yii\web\View
 * @var $model common\models\NotificationLog
 */
use common\models\NotificationLog;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

$this->title = 'E-mail Details';
?>
<div class="row">
    <div class="col-sm-12">
        <h3><?= ArrayHelper::getValue(NotificationLog::getTypeList(), $model->type);?> sent to <?= $model->to_address; ?></h3>
        <hr>
        <p><h4>Subject:</h4> <?= $model->subject; ?></p>
        <hr>
        <p>
            <h4>Body:</h4>
            <?= $model->body; ?>
        </p>
        <hr>
        <?= Html::a('Back', Url::previous(), ['class' => 'btn btn-info']);?>
    </div>
</div>

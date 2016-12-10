<?php
use common\models\Charloginlog;
use kartik\grid\GridView;
use kartik\icons\Icon;
use yii\helpers\Url;

$this->title = 'Welcome '.Yii::$app->user->id;
?>
<div class="row">
    <div class="col-sm-4">
        <span class="badge" style="font-size: medium;"><a href="<?= Url::to(['online-players']);?>" style="text-decoration: none; color: white"><?= Charloginlog::onlinePlayerCount();?> Online Players</a></span>
    </div>
    <div class="col-sm-4">
        <span class="badge" style="font-size: medium;"><a href="<?= Url::to(['player-kills']);?>" style="text-decoration: none; color: white">Recent Player Kills</a></span>
    </div>
    <div class="col-sm-4">
        <span class="badge" style="font-size: medium;"><a href="<?= Url::to(['top-players']);?>" style="text-decoration: none; color: white">Top 50 Players</a></span>
    </div>
</div>
<h2>Welcome to account control panel</h2>
<h4>Make sure your character is <span class="text-danger">OFFLINE</span> before doing any operation. Not following this rule might mess up your character making it unusable!</h4><hr>
<?= GridView::widget([
    'id' => 'char-grid',
    'dataProvider' => $characterDataProvider,
    'columns' => $characterSearchModel->columnMap,
    'containerOptions'=>['style'=>'overflow: auto'],
    'headerRowOptions'=>['class'=>'kartik-sheet-style'],
    'filterRowOptions'=>['class'=>'kartik-sheet-style'],
    'bordered' => true,
    'responsive' => true,
    'pjax' => true,
    'toolbar' => false,
    'export' => false,
    'panel'=>[
        'type' => GridView::TYPE_PRIMARY,
        'heading' => Icon::show('users').'Active Characters',
    ],
    'persistResize' => false,
    'summary' => false
]); ?>
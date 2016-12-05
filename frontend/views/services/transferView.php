<?php

/* @var $this yii\web\View
 * @var $msg String
 */

use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Transfer Request';
?>
<h3 class="text-info"><?= $msg; ?></h3><br>
<?= Html::a(Icon::show('home').'Home', Url::to(['/']), ['class' => 'btn btn-primary'])?>
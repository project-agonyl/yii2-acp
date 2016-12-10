<?php

/* @var $this yii\web\View
 * @var $model common\models\Playerpkinfo
 */
use kartik\icons\Icon;
use yii\helpers\Url;

?>
<div class="col-sm-12">
    <center style='color: green'>
        <h5 style="font-weight: bold">
            <?= $model->pker ?>(<?= $model->pker_rb ?>, <?= $model->pker_lvl ?>) of <?= ($model->pker_nation == 0)?'<font color="red">Temoz</font>':'<font color="skyblue">Quanato</font>'; ?> killed
            <?= $model->pked ?>(<?= $model->pked_rb ?>, <?= $model->pked_lvl ?>) of <?= ($model->pked_nation == 0)?'<font color="red">Temoz</font>':'<font color="skyblue">Quanato</font>'; ?> at
            <?= $model->loc; ?>
        </h5>
    </center>
</div>
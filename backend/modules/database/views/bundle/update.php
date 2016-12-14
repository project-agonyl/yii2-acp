<?php

/* @var $this yii\web\View
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $model backend\modules\admin\models\Eshop
 */

$this->title = 'Update E-shop Item '.$model->id;
?>
<h2>Update E-shop Item</h2>
<?= $this->render('_form', ['model' => $model]); ?>

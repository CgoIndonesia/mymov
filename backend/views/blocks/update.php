<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Json;
/* @var $this yii\web\View */
/* @var $model common\models\Blocks */

$this->title = 'Update Block';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"> <?= Html::encode('Update Block: ' .$model->title); ?></h3>
    </div>

    <?php switch ($model->name) {
        case $model::BLOCK_SLIDER:
        echo $this->render('_slider', ['model' => $model]);
        break;
        case $model::BLOCK_PRICELIST:
        echo $this->render('_pricelist', ['model' => $model]);
        break;
   } ?>


</div>

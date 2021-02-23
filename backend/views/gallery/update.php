<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Update Gallery - '.$gallery->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
    </div>

    <?= $this->render('_form', [
         'gallery' => $gallery,
         'modelsMedia' => $modelsMedia,
         'type' => $type,
    ]) ?>

</div>
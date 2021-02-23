<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Update User: ' . $model->username;
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"> <?= Html::encode('Update User: ' . ' ' . $model->username); ?></h3>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>

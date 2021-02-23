<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\file\FileInput;
use yii\helpers\Json;

/* @var $this yii\web\View */
/* @var $model common\models\Feedbacks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-12">
           <?= $form->field($model, 'feedback_text')->textArea() ?>
    </div>
    <div class="col-md-12">
        <label for="images">Photo</label>
        <?php
        echo FileInput::widget([
            'name' => 'files[]',
            'options' => ['accept' => 'image/*', 'multiple' => true],
            'pluginOptions' => [
                'showRemove' => false,
                'uploadAsync' => false,
                'overwriteInitial' => false,
                'initialPreviewAsData' => true, // identify if you are sending preview data only and not the raw markup
                'initialPreviewFileType' => 'image',
                'initialPreview' => !empty($initialPreview) ? $initialPreview : [],
                'initialPreviewConfig' => !empty($initialPreviewConfig) ? $initialPreviewConfig : [],
                'maxFileCount' => 20,
                'minFileCount' => 1,
                'uploadUrl' => Url::to(['/file/upload']),
                'uploadExtraData' => ['folder' => 'feedbacks'],
            ]
        ]);
        ?>
    </div>
</div>

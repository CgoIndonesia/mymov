<?php

use yii\helpers\Html;
use yii\helpers\Url;
use vova07\imperavi\Widget;
use kartik\file\FileInput;
use yii\helpers\Json;

/* @var $this yii\web\View */
/* @var $model common\models\Team */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-12">
        <?= $form->field($model, 'description')->widget(Widget::className(), [
            'settings' => [
            'minHeight' => 200,
       
            ]
            ]); ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'facebook')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'twitter')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'google_plus')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'instagram')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-12">
        <label for="images">Photo</label>
        <?php
            echo FileInput::widget([
                'name' => 'files[]',
                'options' => ['accept' => 'image/*','multiple' => true],
                'pluginOptions' => [
                'showRemove' => false,
                'uploadAsync'=> false,
                'overwriteInitial'=> false,
                'initialPreviewAsData'=> true, // identify if you are sending preview data only and not the raw markup
                'initialPreviewFileType' =>'image',
                'initialPreview'=> !empty($initialPreview) ? $initialPreview : [],
                'initialPreviewConfig'=>!empty($initialPreviewConfig) ? $initialPreviewConfig : [],
                'maxFileCount'=> 1,
                'minFileCount'=> 1,
                'uploadUrl' => Url::to(['/file/upload']),
                'uploadExtraData' => ['folder'=>'team'],
                ],
                ]);
                ?>
    </div>
</div>
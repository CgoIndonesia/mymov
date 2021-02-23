<?php

use yii\helpers\Html;
use yii\helpers\Url;
use vova07\imperavi\Widget;
use kartik\file\FileInput;
use yii\helpers\Json;

/* @var $this yii\web\View */
/* @var $model common\models\Guides */
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
        <?= $form->field($model, 'description')->widget(Widget::className(), [
            'settings' => [
            'minHeight' => 200,
            'imageUpload' => Url::to(['/file/upload-content']),
            'imageManagerJson' => Url::to(['tours/files-get']),
            'imageDeleteCallback' => new \yii\web\JsExpression("function(url, image)
                { $.ajax({
                 url:'" . Url::to(['file/delete-content']) . "',
                 type: 'post',
                 data: {image:url, folder:'tours'}});}"),
            'plugins' => [
            'imagemanager',
            'fullscreen'
            ]
            ]
            ]); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'price')->textInput(['type' => 'number']) ?>
        </div>   
         <div class="col-md-6">
            <?= $form->field($model, 'location')->textInput() ?>
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
                'uploadExtraData' => ['folder'=>'guides'],
                ]
                ]);
                ?>
            </div>
        </div>

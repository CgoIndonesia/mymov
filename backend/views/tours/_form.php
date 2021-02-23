<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\switchinput\SwitchInput;
use vova07\imperavi\Widget;
use kartik\file\FileInput;
use kartik\checkbox\CheckboxX;
use yii\helpers\Json;

/* @var $this yii\web\View */
/* @var $model common\models\Tours */
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
        <?= $form->field($model, 'short_description')->widget(Widget::className(), [
            'settings' => [
            'minHeight' => 200,
            'fullscreen'
            ]]); ?>
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
        <div class="col-md-4">
            <?= $form->field($model, 'price')->textInput(['type' => 'number']) ?>
        </div>
    <div class="col-md-2">
        <?= $form->field($model, 'maximum_members')->textInput(['type' => 'number']) ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'local_guides')->textInput(['type' => 'number']) ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'estimated_time')->textInput(['type' => 'number']) ?>
    </div>
    <div class="col-md-2">
    <?= $form->field($model, 'duration_type')->dropDownList($model::GetDurationType(null)); ?>
    </div>
        <div class="col-md-12">
           <label for="features">Features</label>
           <div class="row">
            <?php
            !empty($features) != null ? $features : $features = [];
            foreach ($model::GetTourFeatures(null) as $key => $feature) {
                echo '<div class="col-lg-3">';
                echo CheckboxX::widget([
                   'name'=>'features['.$key.']',
                   'value'=> array_key_exists($key, $features) ? 1 :'',
                   'model' =>$model,
                   'options'=>['id'=>$key],
                   'pluginOptions'=>['threeState'=>false]
                   ]);
                echo '<label class="cbx-label" for="s_5">'.$feature['label'].'</label></div>';
            }
            ?>
        </div>
    </div>
    
    <div class="col-md-12">
        <label for="images">Images</label>
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
                'maxFileCount'=> 20,
                'minFileCount'=> 1,
                'uploadUrl' => Url::to(['/file/upload']),
                'uploadExtraData' => ['folder'=>'tours'],
                ]
                ]);
                ?>
            </div>
    <div class="col-md-12">
        <?= $form->field($model, 'video')->textInput(['maxlength' => true]) ?>
    </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'ishome', [
                            'template' => '{input}{label}{error}{hint}',
                            'labelOptions' => ['class' => 'cbx-label'],
                            ])->widget(CheckboxX::classname(), [
                            'autoLabel'=>false,
                            'pluginOptions' => ['threeState' => false]
                            ]); ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <?= $form->field($model, 'status')->widget(SwitchInput::classname(), [
                        'type' => SwitchInput::CHECKBOX,
                        'value' => 10
                        ]); ?>
                    </div>
                </div>

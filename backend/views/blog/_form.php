<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\switchinput\SwitchInput;
use andru19\fancytree\FancytreeWidget;
use bajadev\ckeditor\CKEditor;
use kartik\file\FileInput;
use common\models\Categories;

/* @var $this yii\web\View */
/* @var $model common\models\Blog */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-md-6">

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-md-12">
        <label for="images">Image</label>
        <?php
        echo FileInput::widget([
            'name' => 'files[]',
            'options' => ['accept' => 'image/*', 'multiple' => false],
            'pluginOptions' => [
                'showRemove' => false,
                'uploadAsync' => false,
                'overwriteInitial' => true,
                'initialPreviewAsData' => true, // identify if you are sending preview data only and not the raw markup
                'initialPreviewFileType' => 'image',
                'initialPreview' => !empty($initialPreview) ? $initialPreview : [],
                'initialPreviewConfig' => !empty($initialPreviewConfig) ? $initialPreviewConfig : [],
                'maxFileCount' => 1,
                'minFileCount' => 1,
                'uploadUrl' => Url::to(['/file/upload']),
                'uploadExtraData' => ['folder' => 'content'],
            ]
        ]);
        ?>
    </div>
    <div class="col-md-12">
        <?= $form->field($model, 'content')->widget(CKEditor::className(), [
            'options' => ['rows' => 6],
            'editorOptions' => [
             'preset' => 'custom',
            'extraPlugins' => 'imageuploader',
            'filebrowserBrowseUrl' => 'browse-images',
            'filebrowserUploadUrl' => 'upload-images',
            'toolbarGroups' => [
                ['name' => 'clipboard', 'groups' => ['undo', 'clipboard']],
                ['name' => 'editing', 'groups' => [ 'find', 'selection', 'spellchecker', 'editing' ]],
                ['name' => 'links', 'groups' => [ 'links' ]],
                ['name' => 'insert', 'groups' => [ 'insert' ] ],
                ['name' => 'forms', 'groups' => ['forms']],
                ['name' => 'tools', 'groups' => ['tools']],
                ['name' => 'document', 'groups' => [ 'mode', 'document', 'doctools' ]],
                ['name' => 'others', 'groups' => ['others']],
                ['name' => 'basicstyles', 'groups' => [ 'basicstyles', 'cleanup' ]],
                ['name' => 'paragraph', 'groups' => [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ]],
                ['name' => 'styles', 'groups' => [ 'styles' ]],
                ['name' => 'colors', 'groups' => [ 'colors' ]]
            ],

                ],
        ]) ?>
    </div>

    <div class="col-md-12">
        <?= $form->field($model, 'status')->widget(SwitchInput::classname(), [
            'type' => SwitchInput::CHECKBOX,
            'value' => 10
        ]); ?>
    </div>
    <div class="col-md-12">
        <?= $form->field($model, 'cache')->widget(SwitchInput::classname(), [
            'type' => SwitchInput::CHECKBOX,
            'value' => 10
        ]); ?>
    </div>


</div>
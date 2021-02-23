<?php

use faryshta\widgets\JqueryTagsInput;

/* @var $this yii\web\View */
/* @var $model common\models\Categories */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'seo_title')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'seo_description')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'seo_keywords')->widget(JqueryTagsInput::classname(), [
            'model' => $model,
            'attribute' => 'seo_keywords',
            'clientOptions' => [
                'width' => '100%',
                'height' => '100%'
            ]
        ]); ?>
    </div>
</div>
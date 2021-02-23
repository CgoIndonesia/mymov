<?php

use yii\helpers\Html;
use andru19\fancytree\FancytreeWidget;
use yii\web\JsExpression;
use kartik\switchinput\SwitchInput;

/* @var $this yii\web\View */
/* @var $model common\models\Categories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-12">
        <?= $form->field($model, 'parent')->widget(FancytreeWidget::classname(), [
            'name' => 'fancytree',

            'source' => $model->getCategories($model->id),
            'parent' => $model->id && !empty($model->parent()->one()->id) ? $model->parent()->one()->id : null,
            'options' => [
                'selectMode' => 1,
                'checkbox' => true
            ],
            'titlesTabbable' => true,
            'clickFolderMode' => FancytreeWidget::CLICK_ACTIVATE_EXPAND,

        ]); ?>


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

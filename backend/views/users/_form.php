<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\switchinput\SwitchInput;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>



<?php $form = ActiveForm::begin([
    'id'=>$model->formName(),
    'enableAjaxValidation' => true
]); ?>
<div class="box-body">
    <div class="col-md-6">
        <?= $form->field($model, 'username')->textInput(['class' => 'form-control']) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'password')->PasswordInput(['class' => 'form-control']) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'email')->textInput(['class' => 'form-control']) ?>
    </div>

    <div class="col-md-12">
        <?= $form->field($model, 'status')->widget(SwitchInput::classname(), [
            'type' => SwitchInput::CHECKBOX,
            'value' => 10
        ]); ?>
    </div>
</div>
<div class="box-footer">
    <div class="col-md-12">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>



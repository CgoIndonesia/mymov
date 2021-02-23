<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::$app->name . ' - Login';
?>

<div class="row">
    <div class="col-md-12 login-wrapper">
        <div class="flex-container">

            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <?php if (!empty($model->getFirstError('password'))) {
                echo '<div class="inputwrapper login-alert"><div class="alert alert-error">' . $model->getFirstError('password') . '</div></div>';
            } ?>
            <?= $form->field($model, 'username', [
                'template' => "<div class=\"inputwrapper\">{input}</div>"
            ])->textInput(['autofocus' => true, 'class' => 'form-input', 'placeholder' => 'Username']) ?>
            <?= $form->field($model, 'password', [
                'template' => "<div class=\"inputwrapper\">{input}</div>"
            ])->passwordInput(['class' => 'form-input', 'placeholder' => 'Password']) ?>

            <div class="inputwrapper">
                <?= Html::submitButton('Login', ['class' => 'btn-primary', 'name' => 'login-button']) ?>
            </div>

            <?= $form->field($model, 'rememberMe', [
                'template' => "<div class=\"inputwrapper\">{input}</div>",
            ])->checkbox() ?>

            <?php ActiveForm::end(); ?>
            <div class="copyright">Copyright &copy; <?= date('Y') ?> INLITE-GROUP All rights
                reserved.</div>
        </div>
    </div>
</div>
 

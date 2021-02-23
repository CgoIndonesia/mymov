<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;
use yii\helpers\Json;

/* @var $this yii\web\View */
/* @var $model common\models\Blocks */
/* @var $form yii\widgets\ActiveForm */
$tabs = [];
$model->content = Json::decode($model->content);
?>


     <?php $form = ActiveForm::begin([
        'action' => 'slider',

        'options' => [
            'enctype' => 'multipart/form-data',
     
        ],
    ]); ?>
 
        <?php foreach ($model->content as $key => $slide) {
        $tabs[] = [
            'label' => 'Slide ' . ($key + 1),
            'content' => $this->render('_slide-form', [
                'index' => $key,
                'data' => $slide,
                'form' => $form,
                'model' => $model,
            ]),
        ];
    } ?>

        <div class="nav-tabs-custom">
            <?= Tabs::widget([
                'items' => $tabs,
            ]) ?>
        </div>

    <div class="box-body">
   <div class="col-md-12">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
 </div>


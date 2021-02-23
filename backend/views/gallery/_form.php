<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
/* @var $this yii\web\View */
/* @var $model common\models\Tours */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin([
    'enableClientValidation' => false,
    'enableAjaxValidation' => true,
    'validateOnChange' => true,
    'validateOnBlur' => false,
    'options' => [
    'enctype' => 'multipart/form-data',
    'id' => 'dynamic-form'
    ]
    ]); ?>
    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($gallery, 'name')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <?php switch ($type ) {
            case 'photos':
            echo $this->render('_form_gallery_photos', [
                'form' => $form,
                'gallery' => $gallery,
                'modelsMedia' => $modelsMedia,
                ]);
            break;
            case 'videos':
            echo $this->render('_form_gallery_videos', [
                'form' => $form,
                'gallery' => $gallery,
                'modelsMedia' => $modelsMedia
                ]);
            break;
        } ?>

    </div>
    <div class="box-footer">
        <div class="col-md-12">
            <?= Html::submitButton($gallery->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
    
    
    
    
    
    
    
    
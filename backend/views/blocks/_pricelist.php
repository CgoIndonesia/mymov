<?php


use vova07\imperavi\Widget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * Created by PhpStorm.
 * User: ANDREW
 * Date: 12/18/2016
 * Time: 12:54 AM
 */
?>
<?php $form = ActiveForm::begin([
    'id' => $model->formName(),
    'options' => [
        'enctype' => 'multipart/form-data'
    ]

]); ?>


<div class="box-body">
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'content')->widget(Widget::className(), [
                'settings' => [
                    'minHeight' => 200,
                ]
            ]); ?>
        </div>
    </div>
</div>
<div class="box-footer">
    <div class="col-md-12">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn
        btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
</div>
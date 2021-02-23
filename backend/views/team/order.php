<?php
use kartik\sortinput\SortableInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Team Order';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
    </div>

  <?php $form = ActiveForm::begin([
        'id' => $model->formName(),
        'options' => [
            'enctype' => 'multipart/form-data'
        ]
    ]); ?>
     <div class="box-body">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<?php 
 
echo $form->field($model, 'order')->widget(SortableInput::classname(), [

    'items' => $items,
    'hideInput' => true,
    'sortableOptions' =>  [ 'type'=>'grid',],
    'options' => ['class'=>'form-control', 'readonly'=>true]
]);

?>
  </div>
</div>
</div>
<div class="box-footer">
        <div class="col-md-12">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']); ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
  

</div>
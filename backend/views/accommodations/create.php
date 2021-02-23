<?php

use yii\helpers\Html;
use yii\bootstrap\Tabs;
use yii\widgets\ActiveForm;



/* @var $this yii\web\View */
/* @var $model common\models\Accommodations */

$this->title = 'Create Accommodation';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $this->registerJs("
   $('#{$model->formName()}').on('afterValidate', function (e) {
   $('.tab-content').find('.tab-pane').each(function(){ 
   if ($('#'+ this.id).find('.help-block').text().length > 0) {
  $(\"a[href='#\"+this.id+\"']\").tab('show');
  } });});", \yii\web\View::POS_END);
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

    <div class="nav-tabs-custom">

        <?= Tabs::widget([
            'items' => [
                [
                    'label' => 'Details',
                    'content' => $this->render('_form', [
                        'model' => $model,
                        'form' => $form,
                    ]),
                    'active' => true,
                ],
                [
                    'label' => 'SEO',
                    'content' => $this->render('_seo', [
                        'model' => $model,
                        'form' => $form,
                    ]),
                ],
            ],
        ]);
        ?>
    </div>
    <div class="box-body">
        <div class="col-md-12">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn
        btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

</div>

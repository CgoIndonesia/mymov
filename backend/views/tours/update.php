<?php

use yii\helpers\Html;
use yii\bootstrap\Tabs;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Tours */

$this->title = 'Update Tour: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
    </div>
    <?php $form = ActiveForm::begin([
        'id'=>$model->formName(),
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
                        'initialPreview' => $initialPreview,
                        'initialPreviewConfig' => $initialPreviewConfig,
                        'features' => $features

                    ]),
                    'active' => true
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

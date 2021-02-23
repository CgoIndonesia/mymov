<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var \yii\bootstrap\ActiveForm */
/* @var integer $index */
/* @var \app\modules\admin\models\Block $model */

?>
 <div class="box-body">
<?= $form->field($model, "content[$index][title]")->textInput()->label('Title') ?>

<?= $form->field($model, "content[$index][description]")->textInput()->label('Description') ?>

<?= $form->field($model, "content[$index][image]")->widget(FileInput::className(), [
    'pluginOptions' => [
        'uploadAsync' => false,
        'allowedFileTypes' => ['image'],
        'initialPreviewAsData'=> true,
        'initialPreview' => empty($model->content[$index]['image']) ? [] : ['/uploads/slider/'.$model->content[$index]['image']],
        'initialPreviewConfig'=> [
                'caption'=>empty($model->content[$index]['image']),
                'width'=>'120px',
        ],
        'initialPreviewShowDelete' => false,
        'showRemove' => false,
        'showUpload' => false,
    ],
])->label('Image') ?>
</div>
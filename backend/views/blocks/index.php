<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Blocks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
    </div>


    <div class="box-body">

    <?php \yii\widgets\Pjax::begin(); ?>        
     <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'showFooter' => true,
        'layout' => "{items}\n{summary}\n{pager}",
        'pager' => [
            'firstPageLabel' => 'First',
            'lastPageLabel' => 'Last',
            'nextPageLabel' => 'Next',
            'prevPageLabel' => 'Previous',
        ],        'columns' => [
            'title',

              ['class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                                 'visibleButtons' => [
                                        'view'=>false,
                                        'delete'=>false,
            ]
        ],
        ],
    ]); ?>
     <?php \yii\widgets\Pjax::end(); ?> 
</div>
</div>

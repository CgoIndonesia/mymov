<?php

use yii\helpers\Html;
use fedemotta\datatables\DataTables;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Blog';

?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="box-body">

        <?= DataTables::widget([

            'dataProvider' => $dataProvider,
            'tableOptions' => [
                'class' => 'table table-bordered table-hover'
            ],
            'layout' => "{items}\n{pager}\n{summary}",
            'columns' => [
                'id',
                'title',
                [
                    'label' => 'Status',
                    'value' => function ($model) {
                        $status = $model::GetPostStatus($model->status);
                        return $status;
                    }
                ],
                ['class' => 'yii\grid\ActionColumn',
                    'header' => 'Actions',
                    'visibleButtons' => [
                        'view' => false
                    ],
                ],
            ],
        ]); ?>
    </div>
    <div class="box-footer">
        <?= Html::a('Create Post', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Change order', ['order'], ['class' => 'btn bg-orange']) ?>
    </div>
</div>

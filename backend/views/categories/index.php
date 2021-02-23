<?php

use yii\helpers\Html;
use fedemotta\datatables\DataTables;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
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
                        $status = $model::GetUserStatus($model->status);
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
        <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
    </div>
</div>

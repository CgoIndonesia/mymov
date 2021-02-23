<?php

use yii\helpers\Html;
use fedemotta\datatables\DataTables;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Guides';

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
            'name',
            [
            'label' => 'Descrption',
            'value' => function ($model) {
                $description = strip_tags($model->description);
                if (strlen($description) > 400) {
                    $stringCut = substr($description, 0, 400);
                    $description = substr($stringCut, 0, strrpos($stringCut, ' ')).'...';
                }
                return strip_tags($description);
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
            <?= Html::a('Create Guide', ['create'], ['class' => 'btn btn-success']) ?>
            <?= Html::a('Change order', ['order'], ['class' => 'btn bg-orange']) ?>
        </div>
    </div>

<?php

use yii\helpers\Html;
use fedemotta\datatables\DataTables;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Team';

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
            'position',
    
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
            <?= Html::a('Create Member', ['create'], ['class' => 'btn btn-success']) ?>
            <?= Html::a('Change order', ['order'], ['class' => 'btn bg-orange']) ?>
        </div>
    </div>

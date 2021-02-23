<?php

use yii\helpers\Html;
use fedemotta\datatables\DataTables;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gallery - '.Yii::$app->request->get('type');

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
            'name',
        
                ['class' => 'yii\grid\ActionColumn',
                    'header' => 'Actions',
                    'visibleButtons' => [
                        'view' => false,
                        'delete' => false
                    ],
                     'buttons' => [
                        'update' => function ($url, $model) {
                            return Html::a(
                                '<span class="glyphicon glyphicon-pencil"></span>',
                                $url . '&type=' . Yii::$app->request->get('type'));
                        },
                    ],
                ],
        ],
    
    ]); ?>
    </div>

</div>

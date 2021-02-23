<?php

use yii\helpers\Html;
use fedemotta\datatables\DataTables;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="box-body">
        <?= DataTables::widget([
            'tableOptions' => [
                'class' => 'table table-bordered table-hover'
            ],

            'dataProvider' => $dataProvider,
            'layout' => "{items}\n{pager}\n{summary}",
            'columns' => [
                'id',
                'username',
                'email:email',
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
                    'buttons' => [
                        'update' => function ($url, $model) {
                            return Html::a(
                                '<span class="glyphicon glyphicon-pencil"></span>',
                                $url . '&role=' . Yii::$app->request->get('role'));
                        },
                        'delete' => function ($url, $model) {
                            return Html::a(
                                '<span class="glyphicon glyphicon-trash"></span>',
                                $url . '&role=' . Yii::$app->request->get('role'), ['data-method' => 'POST']);
                        },
                    ],
                ],
            ],
        ]); ?>

    </div>
    <div class="box-footer">
        <?= Html::a('Create User', ['create?role=' . Yii::$app->request->get('role')], ['class' => 'btn btn-success']) ?>
    </div>
</div>

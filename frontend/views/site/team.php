<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\widgets\ListView;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'About Us';

?>
<section class="pageTitle about">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="titleTable">
                    <div class="titleTableInner">
                        <div class="pageTitleInfo">
                            <h1><?= $this->title; ?></h1>
                            <div class="under-border"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="breadcrumb-container">
    <div class="container">
        <ol class="breadcrumb">
            <?= Breadcrumbs::widget([
                'itemTemplate' => "<li><li>{link}</li></li>\n", // template for all links
                'homeLink' => [
                    'label' => 'Home',
                    'url' => Url::home(),
                    'template' => "<li><i class='fa fa-home pr-10'></i><b>{link}</b></li>\n",
                ],
                'links' => [
                    [
                        'label' => 'Team',
                        'template' => "<li><b>{link}</b></li>\n", // template for this link only
                    ],
                ],
            ]);
            ?>
        </ol>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="sectionTitle">
                <h2><span>our Team</span></h2>
                <p>Check out our awesome team</p>
            </div>
        </div>
    </div>
    <div class="row">
  <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemOptions' => ['class' => 'item'],
                'layout' => "{items}\n{pager}",
      'itemView' => function ($model) {
          return $this->render('_team',['model' => $model]);
      }
            ]) ?>

    


    </div>

</div>
          

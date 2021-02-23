<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Local Guide - Trip consultant';

?>
<section class="pageTitle guides";">
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <div class="titleTable">
              <div class="titleTableInner">
                <div class="pageTitleInfo">
                  <h1><?=$this->title;?></h1>
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
                        'label' => 'Guides',
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
                <h2><span>Local Guide - Trip consultant</span></h2>
                <span> We redesigned our classic "guide" concept and transformed that into your new "local friend". This service is a special design for all our customers who need professional customer care services. We offer airport services and train station pick up in a unique and a very comfortable way. Without forgetting, we always have to treat our guests with a small surprise, we love to enchant them with unique welcome pack. They can always feel relaxed, safe and enjoy every single moment with our professional team, from their arrival time until their departure. Discover now how the new "local friend" will refresh your holiday time and don’t hesitate.    </span>
            </div>
        </div>


    </div>
    <div class="row">
  <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemOptions' => ['class' => 'item'],
                'layout' => "{items}\n{pager}",
      'itemView' => function ($model) {
          return $this->render('_guides',['model' => $model]);
      }
            ]) ?>

    


    </div>

</div>
          

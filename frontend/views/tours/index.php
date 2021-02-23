<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\widgets\Breadcrumbs;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Private Trips';
?>
<section class="pageTitle tours" ;">
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
                        'label' => 'Tours',
                        'template' => "<li><b>{link}</b></li>\n", // template for this link only
                    ],
                ],
            ]);
            ?>
        </ol>
    </div>
</div>
<section class="packagesSection">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="sectionTitle">
                    <h2><span class="greyBg">Private tours ​guide</span></h2>
                    <span>From our own experiences we would love to share and develop a new way of travel and guiding. All the
                experience we have so far leads us to seeing and understanding better what someone like you needs when
                you travel. We offer you the a chance to experience, not only a classic trip that you cannot find in any
                kind of classic agency, but a new way to approach the local life, reality, people and their real
                lifestyle. We connect you with the place & people and their own values. If you want to experience a
                different way of travel you can choose any of our tours below.</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">

                <!-- START FIXED TOUR-->
                <div class="media packagesList">
                    <a class="media-left" href="#'">
                        <img class="'media-object" src='img/fixed-tour.jpg'/>
                    </a>
                    <div class="media-body">
                        <div class="bodyLeft">
                            <h4 class="media-heading"> Customize your trip</h4>

                            <p> It works like “a la carte” restaurant menu. We help to build your own personalized trip
                                concerning your ideas and wishes. Private consultant with on field experience will
                                suggest you the best solutions and will design the trip you dreamed about it. We
                                guarantee you the safety, entertainment and unforgettable experience. The only thing you
                                need to do is to contact us here. </p>
                        </div>
                        <div class="bodyRight">
                            <div class="bookingDetails">

                                <?= Html::a('Contact', Url::to(['site/contact']), ['class' => 'custom-tour-button btn buttonTransparent clearfix']); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END FIXED TOUR-->
                <?= ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemOptions' => ['class' => 'item'],
                    'layout' => "{items}\n{pager}",
                    'pager' => [
                        'prevPageLabel' => ' <span aria-hidden="true"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>Previous</span>',
                        'nextPageLabel' => '<span aria-hidden="true">Next<i class="fa fa-long-arrow-right" aria-hidden="true"></i></span>',
                        'view' => function ($model) {
                            return $this->render('_items', ['model' => $model]);

                        }],
                    'itemView' => function ($model) {
                        return $this->render('_items', ['model' => $model]);
                    }
                ]) ?>

            </div>
        </div>

    </div>
</section>

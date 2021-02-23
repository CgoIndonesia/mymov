<?php
/**
 * Created by PhpStorm.
 * User: ANDREW
 * Date: 12/14/2016
 * Time: 10:10 PM
 */
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;

$this->title = 'Media';
?>
<section class="pageTitle media-page">
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
                        'label' => 'Media',
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
                <h2><span>Watch Our Gallery</span></h2>
                <p>My Movie Travel</p>
                <span class="media-desc">Ever wondered while travelling, what could it be like if you had someone there who could capture all of your adventures, emotions, people, landscapes, the food - all wrapped up in one neat film? It doesn’t have to be only you with your selfie camera, there is a lot of great stuff you need other than that.
How many photos or videos have you taken in the past that never watched them again or taken the time to edit? Too many, I’m sure!
Times have changed and you can now have your own camera crew experience with ‘My Movie Travel’. No matter where you are, on holiday, a short break, an adventure of a lifetime, travelling to all corners of the earth, someone can be there to catch the best moments of your adventures.
Once you are impressed with the materials recorded, we will then masterfully process all of these and add music, of your taste, in our studio to produce a truly original and personalized movie!  You will love it so much, you will want to share it on Social Media and watch it time and time again. It will be an incredibly unique memory of your adventures.
You can choose to receive your personalized film either by Cloud Transfer or on DVD. We aim to process materials within 5 to 10 days so you can share your memories quickly with friends and family. For us, the most important thing is happiness and we want to help you make memories that will last a lifetime. After all who doesn’t cherish their memories, here is a great chance for you to try this out.</span>
            </div>
        </div>
    </div>

    <div class="row">

            <?= \frontend\components\GalleryWidget::widget(['id'=>\frontend\components\GalleryWidget::MEDIA_PAGE_GALLERY, 'type'=>'media-video']); ?>
    </div>
    <div class="clearfix"></div>
    <div class="row">
            <?= \frontend\components\GalleryWidget::widget(['id'=>\frontend\components\GalleryWidget::MEDIA_PAGE_GALLERY, 'type'=>'media-photo']); ?>
    </div>

</div>
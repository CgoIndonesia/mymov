<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

$this->title = 'My Movie Travel';
$this->registerJs("$('.lazyYT').lazyYT('AIzaSyAGyZSEoHL0ZkWwN7hQppCl3N-lNG6fdnA');", yii\web\View::POS_END);
?>
<section class="pageTitle mymovie">
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
                        'label' => 'Mymovie',
                        'template' => "<li><b>{link}</b></li>\n", // template for this link only
                    ],
                ],
            ]);
            ?>
        </ol>
    </div>
</div>
<section class="aboutWrapper">
    <div class="container">
        <div class="row">
            <div class="sectionTitle">
                <h2><span class="lightBg">What is "My Movie Travel"</span></h2>
                <p>We capture all your emotions & feelings in one single shot!</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p class="mymovie-desc"> Have you ever thought that when you travel that there could be someone who
                    could capture all your
                    emotions, landscape, people, food, activities & adventures that won’t be enough for your selfie
                    camera? How many photos and videos do you take while travelling and you never get to watch them
                    again or rarely do you ever look at them? With my movie travel, no matter where you go on holiday,
                    trip or excursion, to the sea or to the mountains, city center or country side, desert or into the
                    north pole, no matter which event you are attending (wedding, birthday party, camp trip, business
                    meeting, bike trip, family picnic, your kids school events, and so on, someone will be there to
                    catch the best moments. In the end all the material will be carefully processed in our studio in the
                    most original way, and within 5 to 10 days you will receive them on DVD either Cloud Transfer or
                    your own Movie or Film. You can upload it and share it on social media or 33333 keep it for you. The
                    most important thing is satisfaction and keeping a unique memory that can last for long time.
                    Imagine a wedding movie but in a different way. I mean new, fresh and funny, not boring & long. The
                    personalized movie will express your real experience, without “photo shopping” your emotions, the
                    behavior and places you have been visiting. My movie travel will show in an entertaining way to all
                    your friends, the unique way of your travel experience. </p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="lazyYT" data-youtube-id="FkzfwhmmSLs" data-height="315">loading...</div>
            </div>
        </div>
    </div>
</section>
<section class="FeaturesWrapper">
    <div class="container">
        <div class="row">
            <div class="sectionTitle">
                <h2><span class="lightBg">Why you should choose us</span></h2>
                <p>10 reasons to choose us</p>
            </div>
        </div>
        <div class="row choose-us">
            <div class="col-md-4 choose-us-feature">
                <i class="fa fa-caret-square-o-right" aria-hidden="true"></i>
                <span>Is totally new concept!</span>
            </div>
            <div class="col-md-4 choose-us-feature">
                <i class="fa fa-caret-square-o-right" aria-hidden="true"></i>
                <span>Save loads of time of your holiday from taking photos & video</span>
            </div>
            <div class="col-md-4 choose-us-feature">
                <i class="fa fa-caret-square-o-right" aria-hidden="true"></i>
                <span>Competitive prices. Quality/price rapport is the best possible.</span>
            </div>
            <div class="col-md-4 choose-us-feature">
                <i class="fa fa-caret-square-o-right" aria-hidden="true"></i>
                <span>Storage of all your material</span>
            </div>
            <div class="col-md-4 choose-us-feature">
                <i class="fa fa-caret-square-o-right" aria-hidden="true"></i>
                <span>95% of your photos& video you don't look at them again. Many cases probably never again</span>
            </div>
            <div class="col-md-4 choose-us-feature">
                <i class="fa fa-caret-square-o-right" aria-hidden="true"></i>
                <span>High quality video & audio</span>
            </div>
            <div class="col-md-4 choose-us-feature">
                <i class="fa fa-caret-square-o-right" aria-hidden="true"></i>
                <span>We prevent a lot of selfies from filling your phone memory</span>
            </div>
            <div class="col-md-4 choose-us-feature">
                <i class="fa fa-caret-square-o-right" aria-hidden="true"></i>
                <span>High quality editing skills by taking out the best of moments possible.</span>
            </div>
            <div class="col-md-4 choose-us-feature">
                <i class="fa fa-caret-square-o-right" aria-hidden="true"></i>
                <span>Your camera man is meanwhile your local guide and friend, advice you when you need</span>
            </div>
            <div class="col-md-4 choose-us-feature">
                <i class="fa fa-caret-square-o-right" aria-hidden="true"></i>
                <p>Final movie it will be easy to upload and share with all your friends.</p>
            </div>
            <div class="col-md-4 choose-us-feature">
                <i class="fa fa-caret-square-o-right" aria-hidden="true"></i>
                <span>Offers you memories that you will cherish forever</span>
            </div>
        </div>
    </div>
</section>
<section class="CameraProfileWrapper">
    <div class="container">
        <div class="row">
            <div class="sectionTitle">
                <h2><span class="lightBg">Choose your camera man profile</span></h2>
                <span>You also can choose different camera man profile starting with more active and be present almost
                    always next to you, either a low , quiet profile whos recording all images from distance without
                    even notice him or a middle version which will combine both styles.</span>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-sm-4">
                <div class="service-icon">
                    <?= Html::img('img/LowProfile.jpg'); ?>
                </div>
                <h5 class="red-border-bottom">LOW PROFILE</h5> <!-- FOCUS HEADING -->
                <p> <!-- FOCUS DESCRIPTION -->
                    For those who are shy in front of the camera, our camera men will keep safe distance as they shoot
                    your movie "secretly".
                </p>
            </div>
            <div class="col-lg-4 col-sm-4">
                <div class="service-icon">
                    <?= Html::img('img/balanced.jpg'); ?>
                </div>
                <h5 class="red-border-bottom">BALANCED</h5> <!-- FOCUS HEADING -->
                <p> <!-- FOCUS DESCRIPTION -->
                    For those who would like a blend of low and active profile camera man.
                </p>
            </div>
            <div class="col-lg-4 col-sm-4">
                <div class="service-icon">
                    <?= Html::img('img/ActiveProfile.jpg'); ?>

                </div>
                <h5 class="red-border-bottom">ACTIVE PROFILE</h5> <!-- FOCUS HEADING -->
                <p> <!-- FOCUS DESCRIPTION -->
                    Active camera man will be there most of the time next to you, interacting and questioning some of
                    your moments, and having fun together.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="PriceListWrapper">
    <div class="container">
        <div class="row">
            <div class="sectionTitle">
                <h2><span class="lightBg">Service pricelist</span></h2>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= $model->content; ?>
            </div>
        </div>
    </div>

</section>
<section class="BookContainer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-5">
                <?= Html::a('BOOK', Url::to(['site/contact']), ['class' => 'btn buttonWhite mymovie-book-btn']); ?>
            </div>

        </div>
    </div>
</section>
<section class="GalleryWrapper">
    <div class="container">
        <div class="row">
            <div class="sectionTitle">
                <h2><span class="lightBg">Check Our Works</span></h2>

            </div>
        </div>
        <div class="row">
            <?= \frontend\components\GalleryWidget::widget(['id' => \frontend\components\GalleryWidget::MYMOVIE_PAGE_GALLERY, 'type' => 'mymovie-video']); ?>
        </div>
        <div class="row">
            <?= \frontend\components\GalleryWidget::widget(['id' => \frontend\components\GalleryWidget::MYMOVIE_PAGE_GALLERY, 'type' => 'mymovie-photo']); ?>
        </div>
    </div>

</section>

<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
/* @var $this yii\web\View */
/* @var $model common\models\Tours */

$this->title = $model->name;
$this->registerJs("$('.lazyYT').lazyYT('AIzaSyAGyZSEoHL0ZkWwN7hQppCl3N-lNG6fdnA');", yii\web\View::POS_END);
$this->registerJs("$(document).ready(function(){
    $('.fancybox').fancybox({
        openEffect: 'none',
        closeEffect: 'none'
    });
});", yii\web\View::POS_END);
?>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
<section class="pageTitle accommodation" style="background-image:url('/uploads/accommodations/<?= !empty($model->images[0]->name) ? $model->images[0]->name : []; ?>');">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="titleTable">
                    <div class="titleTableInner">
                        <div class="pageTitleInfo">
                            <h1><?= $model->name; ?></h1>
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
                        'label' => 'Acommodations',
                        'template' => "<li><b>{link}</b></li>\n",
                        'url' => Url::to(['accommodations/index']) // template for this link only
                    ],
                    [
                        'label' => $model->name,
                        'template' => "<li><b>{link}</b></li>\n", // template for this link only
                    ],
                ],
            ]);
            ?>
        </ol>
    </div>
</div>
<section class="mainContentSection singlePackage">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="row video-tour">
                    <div class="sectionTitle">
                        <h2><span class="lightBg">Check Out Our Video</span></h2>
                        <p>And let the fun begin!</p>
                    </div>
                    <div class="col-md-12">
                        <div class="lazyYT" data-youtube-id="<?= ltrim(strstr($model->video, 'v='), 'v='); ?>"
                             data-height="200">loading...
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-xs-12">
                <div class="generalInfo">
                    <h2>General Information</h2>
                    <p><?= $model->description; ?></p>
                </div>
            </div>

            <div class="col-xs-12">
                <div class="row featuresInfo">
                    <h2>Accommodation Features</h2>
                    <?php foreach ($features as $feature): ?>
                        <div class="col-md-3 feature">
                            <div class="feature-icon"><i class="<?= $feature['icon']; ?>" aria-hidden="true"></i></div>
                            <div class="feature-label"><?= $feature['label']; ?></div>
                            <div class="feature-description"><?= $feature['description']; ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="BookContainer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-5">
    <span class="accommodation-price">Price From <?= round($model->price, 0); ?>
        &#8364; </span>
                <?= Html::a('BOOK', Url::to(['site/contact']), ['class' => 'btn buttonWhite']); ?>
            </div>

        </div>
    </div>
</section>
<div class="container">
    <div class="row">
        <div class="sectionTitle">
            <h2><span class="lightBg">Check Out Our Gallery</span></h2>
            <p>Welcome to our photo gallery</p>
        </div>
        <div class='list-group gallery'>
            <?php foreach ($model->images as $key => $image): ?>
                <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>

                    <a class="thumbnail fancybox" rel="ligthbox"
                       href="<?= '/uploads/accommodations/' . $image->name; ?>">
                        <img class="img-responsive" alt=""
                             src="<?= '/uploads/accommodations/thumbs_370x270/' . $image->name; ?>"/>
                        <div class='text-right'>
                        </div> <!-- text-right / end -->
                    </a>
                </div> <!-- col-6 / end -->
            <?php endforeach; ?>
        </div> <!-- list-group / end -->
    </div> <!-- row / end -->
</div>

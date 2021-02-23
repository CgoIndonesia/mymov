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

<section class="pageTitle tour" style="background-image:url('/uploads/tours/<?= !empty($model->images[0]->name) ? $model->images[0]->name : []; ?>');">
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
                        'label' => 'Tours',
                        'template' => "<li><b>{link}</b></li>\n",
                        'url' => Url::to(['tours/index']) // template for this link only
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
        <div class="row video-tour">
            <div class="sectionTitle">
                <h2><span class="lightBg">Check Out Our Video</span></h2>
                <p>And let the fun begin!</p>
            </div>
            <div class="col-md-12">
                <div class="lazyYT" data-youtube-id="<?= ltrim(strstr($model->video, 'v='), 'v='); ?>" data-height="200">loading...</div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="well">
                    <div class="row">
                        <div class="col-sm-4 col-xs-12">
                            <div class="infoImage">
                                <?php if (!empty($model->images[0]->name)) {

                                    echo Html::img('/uploads/tours/thumbs_350x220/' . $model->images[0]->name);
                                }

                                ?>
                            </div>
                        </div>
                        <div class="col-sm-5 col-xs-12">
                            <div class="packageInfo">
                                <h4>Information</h4>
                                <dl class="dl-horizontal">
                                    <dt>Maximum Members:</dt>
                                    <dd><?= $model->maximum_members; ?></dd>
                                    <dt>Local Guides:</dt>
                                    <dd><?= $model->local_guides; ?></dd>
                                    <dt>Estimated Time:</dt>
                                    <dd><?=$model->estimated_time.' '.$model::GetDurationType($model->duration_type);?></dd>
                                    <dt>Price:</dt>
                                    <dd><span>From <?= round($model->price, 0); ?> &#8364;</span></dd>
                                </dl>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-12">
                            <div class="packageInfo">
                                <h4><?= $model->name ?></h4>
                                <p><?=$model->estimated_time.' '.$model::GetDurationType($model->duration_type);?> Tour <span><?= round($model->price, 0); ?>
                                        &#8364;</span></p>
                                <?= Html::a('BOOK NOW',Url::to(['site/contact']),['class'=>'btn buttonCustomPrimary'])?>
                            </div>
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
                <div class="featuresInfo">
                    <h2>Tour Features</h2>
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

        <div class="row">
            <div class="sectionTitle">
                <h2><span class="lightBg">Check Out Our Gallery</span></h2>
                <p>Welcome to our photo gallery</p>
            </div>
        <div class='list-group gallery'>
            <?php foreach ($model->images as $key => $image): ?>
            <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>

                <a class="thumbnail fancybox" rel="ligthbox" href="<?= '/uploads/tours/'.$image->name; ?>">
                    <img class="img-responsive" alt="" src="<?= '/uploads/tours/thumbs_350x220/'.$image->name; ?>" />
                    <div class='text-right'>
                    </div> <!-- text-right / end -->
                </a>
            </div> <!-- col-6 / end -->
            <?php endforeach; ?>
        </div> <!-- list-group / end -->
    </div> <!-- row / end -->
        <div class="row">
            <div class="col-xs-12">
                <div class="relatedProduct">
                    <h2>you may also like</h2>
                    <div class="row">
                        <?= \frontend\components\RelatedTours::widget(['current_item_id' => $model->id]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
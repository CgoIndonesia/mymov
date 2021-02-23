<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use frontend\assets\AppAsset;
use frontend\assets\AwesomeAsset;
use common\widgets\Alert;

AppAsset::register($this);
AwesomeAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="PLlNdVjPjF9sUYHgflT541mrXTrRAYQZ6CfreoQ_eiA" />
    <link rel="shortcut icon" href="/favicon.ico?v=4">
    <?= Html::csrfMetaTags() ?>
     <title><?= Html::encode(Yii::$app->name . ' - ' . $this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

    <?php
    NavBar::begin([
        'brandLabel' => '',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-default navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'Blog', 'url' => ['/blog/index']],
        ['label' => 'About', 'url' => ['/blog/about'],
         'items' => [
             ['label' => 'Our Team', 'url' => ['/site/team']],
             ['label' => 'Feedback', 'url' => ['/site/feedbacks']],
        ]],
        ['label' => 'Services', 'url' => ['/site/about'],
         'items' => [
        ['label' => 'My Movie', 'url' => ['/site/my-movie']],
        ['label' => 'Private Trips', 'url' => ['/tours/index']],
             ['label' => 'Local Guide', 'url' => ['/site/guides']],
             ['label' => 'Accommodation', 'url' => ['/accommodations/index']],
    ]],
        ['label' => 'Media', 'url' => ['/site/media']],
        ['label' => 'Contacts', 'url' => ['/site/contact']],
    ];

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

  

        <?= Alert::widget() ?>
        <?= $content ?>


<footer>
<div class="footer clearfix">
    <div class="container">
        <div class="row">
            <div class="col-sm-5 col-xs-12">
                <div class="footerContent">
                     <?= Html::a(Html::img('/img/logo-white.svg', ['class'=>'footer-logo']));?>
                    <p>We are a young and ambitious team who have been working together and have built up this project from scratch since the end of the year 2015.
We gather all personal experiences around which include; more than ten years of travel around the globe, graphic design, over five years of video shooting experience, local guiding, customer service, tourist entertainment, underwater scuba diving and accommodation rentals. But most importantly besides that is our heart & passion to create and develop new concepts. </p>
                </div>
            </div>
            <div class="col-sm-3 col-xs-12">
                <div class="footerContent">
                    <h5>Contact Us</h5>
                    <p>Contact My Movie Travel team now!</p>
                    <ul class="list-unstyled">
                        <li><i class="fa fa-home" aria-hidden="true"></i>Carmignano, Prato - Tuscany - Italy</li>
                        <li><i class="fa fa-phone" aria-hidden="true"></i>+39 334 923 8507</li>
                        <li><i class="fa fa-phone" aria-hidden="true"></i>+34 603 573 956 </li>
                        <li><i class="fa fa-envelope-o" aria-hidden="true"></i><a href="mailTo:mymovietravel@gmail.com">mymovietravel@gmail.com</a></li>
                        <li><i class="fa fa-envelope-o" aria-hidden="true"></i><a href="mailTo:mymovietravel@gmail.com">info@mymovietravel.com </a></li>
                    </ul>
                </div>
            </div>
        
              <div class="col-sm-4 col-xs-12">
                <div class="footerContent">
                    <h5>Follow Us</h5>
                    <p>Check our social media accounts and follow us there for more photos, video and informations. We are ready to reply to any of your questions or inquirees within 24 hours. My movie travel is here for you. Send us your name, phone number and e-mail where we can contact you directly about any concern you have. We are at your service and will reply within 24 hours.</p>
                    <ul class="list-inline">
                  <li><a href="https://www.facebook.com/mymovietravel" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                  <li><a href="https://plus.google.com/u/0/+JohnValentinoT" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                  <li><a href="https://plus.google.com/u/0/+JohnValentinoT" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                  <li><a href="https://www.linkedin.com/in/john-valentino-771a359a" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                        <li><a href="https://www.youtube.com/user/tiperciuc46" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                </ul>
                </div>
            </div>

        </div>

    </div>
</div>
    <div class="copyRight clearfix">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-push-6 col-xs-12">

                    <?php
                    NavBar::begin([
                        'options' => [
                            'class' => 'footer-menu',

                        ],
                        'renderInnerContainer'=>false,
                    ]);
                    $menuItems = [
                        ['label' => 'Home', 'url' => ['/site/index']],
                        ['label' => 'About', 'url' => ['/site/about']],
                        ['label' => 'Accommodations', 'url' => ['/accommodations/index']],
                        ['label' => 'Media', 'url' => ['/site/media']],
                        ['label' => 'Contacts', 'url' => ['/site/contact']],
                    ];

                    echo Nav::widget([
                        'options' => ['class' => 'list-inline'],

                        'items' => $menuItems,
                    ]);
                    NavBar::end();
                    ?>

                </div>
                <div class="col-sm-6 col-sm-pull-6 col-xs-12">
                    <div class="copyRightText">
                        <p class="pull-left">&copy; <?= Yii::$app->name.' '.date('Y') ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

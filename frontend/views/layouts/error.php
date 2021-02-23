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
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="notFoundBg">
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
    ['label' => 'Blog', 'url' => ['/site/blog']],
    ['label' => 'About', 'url' => ['/site/about'],
        'items' => [
            ['label' => 'Our Team', 'url' => ['/site/about']],
            ['label' => 'Feedback', 'url' => ['/site/about']],
        ]],
    ['label' => 'Services', 'url' => ['/site/about'],
        'items' => [
            ['label' => 'My Movie', 'url' => ['/site/about']],
            ['label' => 'Private Trips', 'url' => ['/tours/index']],
            ['label' => 'Local Guide', 'url' => ['/site/about']],
            ['label' => 'Accommodation', 'url' => ['/accommodations/index']],
        ]],
    ['label' => 'Media', 'url' => ['/site/about']],
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
                <div class="col-sm-4 col-xs-12">
                    <div class="footerContent">
                        <?= Html::a(Html::img('/img/logo-white.svg', ['class' => 'footer-logo'])); ?>
                        <p>Did you ever wonder when you’re travelling, what it would be like if you could have someone
                            there who
                            could capture all of your adventures; the emotion, the people, the landscapes, the food -
                            all
                            wrapped up in one neat film? It doesn’t just need to be you with your selfie camera!
                            How many photos and videos have you taken in the past that you have never watched again or
                            taken the
                            time to edit? Too many, I’m sure! We organise for all our customers World tours with camera
                            crew
                            Times have changed and you can now have your own camera crew experience with ‘My Movie
                            Travel’ No
                            matter where you are, on holiday, a short break, an adventure of a lifetime, travelling to
                            all
                            corners of the earth, someone can be there to catch the best moments of your
                            adventures. </p>
                    </div>
                </div>
                <div class="col-sm-4 col-xs-12">
                    <div class="footerContent">
                        <h5>Contact Us</h5>
                        <p>Contact My Movie Travel team now!</p>
                        <ul class="list-unstyled">
                            <li><i class="fa fa-home" aria-hidden="true"></i>Carmignano, Prato - Tuscany - Italy</li>
                            <li><i class="fa fa-phone" aria-hidden="true"></i>+39 334 923 8507</li>
                            <li><i class="fa fa-envelope-o" aria-hidden="true"></i><a
                                    href="mailTo:mymovietravel@gmail.com">mymovietravel@gmail.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4 col-xs-12">
                    <div class="footerContent imgGallery">
                        <h5>Gallery</h5>
                        <div class="row">
                            <div class="col-xs-4">
                                <a class="fancybox-pop" href="img/home/gallery/gallery-1.jpg"><img
                                        src="/img/003-Autumn-Barcelona_d400.jpg" alt="image"></a>
                            </div>
                            <div class="col-xs-4">
                                <a class="fancybox-pop" href="img/home/gallery/gallery-2.jpg"><img
                                        src="/img/003-Autumn-Barcelona_d400.jpg" alt="image"></a>
                            </div>
                            <div class="col-xs-4">
                                <a class="fancybox-pop" href="img/home/gallery/gallery-3.jpg"><img
                                        src="/img/003-Autumn-Barcelona_d400.jpg" alt="image"></a>
                            </div>
                            <div class="col-xs-4">
                                <a class="fancybox-pop" href="img/home/gallery/gallery-4.jpg"><img
                                        src="/img/003-Autumn-Barcelona_d400.jpg" alt="image"></a>
                            </div>
                            <div class="col-xs-4">
                                <a class="fancybox-pop" href="img/home/gallery/gallery-5.jpg"><img
                                        src="/img/003-Autumn-Barcelona_d400.jpg" alt="image"></a>
                            </div>
                            <div class="col-xs-4">
                                <a class="fancybox-pop" href="img/home/gallery/gallery-6.jpg"><img
                                        src="/img/003-Autumn-Barcelona_d400.jpg" alt="image"></a>
                            </div>
                        </div>
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
                        'renderInnerContainer' => false,
                    ]);
                    $menuItems = [
                        ['label' => 'Home', 'url' => ['/site/index']],
                        ['label' => 'About', 'url' => ['/site/about']],
                        ['label' => 'Services', 'url' => ['/site/about']],
                        ['label' => 'Media', 'url' => ['/site/about']],
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
                        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
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

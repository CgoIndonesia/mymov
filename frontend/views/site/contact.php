<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use common\widgets\Alert;

$this->title = 'Contact Us';
$this->registerJsFile('//maps.googleapis.com/maps/api/js?key=AIzaSyDygNjmfj_On3rZA8DFuQwlGk-dAvmytvo&callback=initMap', ['async' =>'defer']);
$this->registerJs("function initMap() {
    var uluru = {lat: 41.394769, lng: 2.169365};
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 8,
        center: uluru,
        scrollwheel: false,
        navigationControl: false,
        mapTypeControl: false,
        scaleControl: false,
        draggable: false,
    });
    var marker = new google.maps.Marker({
        position: uluru,
        map: map
    });
}", yii\web\View::POS_END);

?>
<section class="pageTitle contact-us">
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
                        'label' => 'Contacts',
                        'template' => "<li><b>{link}</b></li>\n", // template for this link only
                    ],
                ],
            ]);
            ?>
        </ol>
    </div>
</div>
<section class="mainContentSection mainContent">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-xs-12">
                <div class="contactInfo">
                    <h2>get in touch</h2>
                    <p>For bookings and questions, please do not hesitate to send us a message either call us on line
                        number or skype. Contact My Movie Travel team now!</p>
                    <div class="media">
                        <a class="media-left" href="#">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">address</h4>
                            <p>Carmignano <br>Prato - Tuscany - Italy</p>
                        </div>
                    </div>
                    <div class="media">
                        <a class="media-left" href="#">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">Phone number</h4>
                            <p>+34 603 573 956 <br>+39 334 923 8507</p>
                        </div>
                    </div>
                    <div class="media">
                        <a class="media-left" href="#">
                            <i class="fa fa-whatsapp" aria-hidden="true"></i>
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">WhatsApp</h4>
                            <p>+39 339 889 6840</p>
                        </div>
                    </div>
                    <div class="media">
                        <a class="media-left" href="#">
                            <i class="fa fa-skype" aria-hidden="true"></i>
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">Skype</h4>
                            <p>My Movie Travel</p>
                        </div>
                    </div>
                    <div class="media">
                        <a class="media-left" href="#">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">email us</h4>
                            <p><a href="mailTo:info@mymovietravel.com">info@mymovietravel.com</a> <br><a
                                    href="mailTo:mymovietravel@gmail.com">mymovietravel@gmail.com</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-8 col-xs-12">
                <div class="contactForm">
                    <?= Alert::widget() ?>
                    <?php $form = ActiveForm::begin(['id' => 'contact-form', 'options' =>
                        ['class'=> 'form']

                    ]); ?>

                    <?= $form->field($model, 'name')->textInput(['autofocus' => true, 'placeholder'=>'Your Name'])->label(false) ?>

                    <?= $form->field($model, 'email')->textInput(['placeholder'=>'Your Email'])->label(false) ?>

                    <?= $form->field($model, 'phone')->textInput(['placeholder'=>'Your Phone'])->label(false) ?>

                    <?= $form->field($model, 'subject')->textInput(['autofocus' => true, 'placeholder'=>'Subject'])->label(false) ?>

                    <?= $form->field($model, 'body')->textArea(['rows' => 6, 'placeholder'=>'Your Message'])->label(false) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Send Message', ['class' => 'btn buttonCustomPrimary', 'name' => 'contact-button']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="mapArea">
    <div id="map"></div>

</section>





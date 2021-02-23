<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;


$this->title = 'Go Travel the World. World tours with camera crew';

$this->registerJs("$('.lazyYT').lazyYT('AIzaSyAGyZSEoHL0ZkWwN7hQppCl3N-lNG6fdnA');", yii\web\View::POS_END);
?>
<div class="container-fluid">
    <!-- Full Page Image Background Carousel Header -->
    <div class="row">

        <?= \frontend\components\Slider::widget() ?>

    </div>
</div>

<!--Facebook Popup-->
<?= \frontend\components\FacebookPopup::widget() ?>
<!--Facebook Popup End-->


<!-- About Us section -->
<section class="aboutWrapper">
    <div class="container">
        <div class="row">
            <div class="sectionTitle">
                <h2><span class="lightBg">About Us</span></h2>
                <p>We capture all your emotions & feelings in one single shot!</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p class="about-us-home">Did you ever wonder when you’re travelling, what it would be like if you could
                    have someone there who
                    could capture all of your adventures; the emotion, the people, the landscapes, the food - all
                    wrapped up in one neat film? It doesn’t just need to be you with your selfie camera!
                    How many photos and videos have you taken in the past that you have never watched again or taken the
                    time to edit? Too many, I’m sure! We organise for all our customers World tours with camera crew
                    Times have changed and you can now have your own camera crew experience with ‘My Movie Travel’ No
                    matter where you are, on holiday, a short break, an adventure of a lifetime, travelling to all
                    corners of the earth, someone can be there to catch the best moments of your adventures. Once you
                    are happy with the materials recorded, we will then masterfully process all of these and add music,
                    of your taste, in our studio to produce a truly original and personalized movie! You will love it so
                    much, you will want to share it on Social Media and watch it time and time again. It will be an
                    incredibly unique memory of your adventures. You can choose to receive your personalized film either
                    by Cloud Transfer or on DVD. We aim to process materials within 5 to 10 days so you can share your
                    memories quickly with friends and family.For us, the most important thing is happiness and we want
                    to help you make memories that will last a lifetime! Life is a movie so play your part! And let ‘My
                    Movie Travel’ reflect “just what you areeeeee” – UNIQUE! </p>
            </div>
        </div>
    </div>

</section>
<section class="whiteSection video-wrapper">
    <div class="container">
        <div class="row">
            <div class="sectionTitle">
                <h2><span class="lightBg">Check Our Video</span></h2>
                <p>Let us to show you what is "My Movie Travel"</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="lazyYT" data-youtube-id="mBbHhA1nliw" data-height="315">loading...</div>
            </div>
        </div>
    </div>
</section>

<section class="mainContentSection packagesSection">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="sectionTitle">
                    <h2><span class="greyBg">Our Services</span></h2>
                    <p>We offer a series of services, starting with personalised trip movies, trip designs,
                        accomodations, activities&entertainment.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-xs-12">
                <div class="thumbnail deals">
                    <?= Html::a(Html::img('img/PersonalisedMovies.png'), Url::to(['site/my-movie'])); ?>

                    <div class="caption">
                        <h4><?= Html::a('Personalised movies', Url::to(['site/my-movie']), ['class' => 'captionTitle']); ?>
                        </h4>
                        <p>Get a unique opportunity to cherish the memories of your holiday, trip and even travelling by
                            letting our professional filmmakers and travel guides catch the best of moments with a high
                            quality, professional camera. At the end of your trip all the material is processed in our
                            studio, so your amazing experiences, places, people and activities are transformed into one
                            great breathtaking travel film. The company could be formed by you, your family, friends, or
                            people you meet along the way during the trip. Read more about this new concept and book
                            your travel movie now. Hurry up and enjoy the time of your life with guaranteed lifetime
                            memory. My Movie Travel - We Movieling-Traveling!</p>
                        <div class="detailsInfo">
                            <?= Html::a('Details', Url::to(['site/my-movie']), ['class' => 'btn buttonTransparent']); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="thumbnail deals services-list">
                    <?= Html::a(Html::img('img/LocalGuide.jpg'), Url::to(['site/guides'])); ?>
                    <div class="caption">
                        <h4><?= Html::a('Local guide & trip designer', Url::to(['site/guides']), ['class' => 'captionTitle']); ?>
                        </h4>
                        <p> We redesigned our classic "guide" concept and transformed that into your new "local friend".
                            This service is a special design for all our customers who need professional customer care
                            services. We offer airport services and train station pick up in a unique and a very
                            comfortable way. Without forgetting, we always have to treat our guests with a small
                            surprise, we love to enchant them with unique welcome pack. They can always feel relaxed,
                            safe and enjoy every single moment with our professional team, from their arrival time until
                            their departure. Discover now how the new "local friend" will refresh your holiday time and
                            don’t hesitate. </p>
                        <div class="detailsInfo">
                            <?= Html::a('Details', Url::to(['site/guides']), ['class' => 'btn buttonTransparent short_text-button']); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="thumbnail deals">
                    <?= Html::a(Html::img('img/485017075_600.jpg'), Url::to(['accommodations/index'])); ?>

                    <div class="caption">
                        <h4><?= Html::a('Accommodations', Url::to(['accommodations/index']), ['class' => 'captionTitle']); ?>
                        </h4>
                        </h4>
                        <p> Do you need a homestay in Tuscany (Italy), Marrakech (Morocco) or even Krakow (Poland)?Book
                            now directly from one of our offices in Tuscany, Marrakech and Krakow. Being a private
                            property, we are our own administrators and you will not have any problems. We offer great
                            deals for your holidays at the best prices without intermediaries. Homes in Marrakech,
                            Maremma & Florence country side in Krakow which is a beautifully polished country side. Our
                            network is not that enormous but for sure we have the best prices for our customers as we
                            treat them all as our private family members. If you book with us now you are going to avoid
                            all agencies fees and you will get the best deal ever. Please check our accommodations
                            description and prices.</p>
                        <div class="detailsInfo">
                            <?= Html::a('Details', Url::to(['accommodations/index']), ['class' => 'btn buttonTransparent']); ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>


<section class="whiteSection">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="sectionTitle">
                    <h2><span>Private Tours</span></h2>
                    <p>The most reccommended tours & activities we guarantee total satisfaction.</p>
                </div>
            </div>
        </div>
        <?= \frontend\components\Tour::widget() ?>

    </div>
</section>

<section class="galleryWrapper">
    <div class="container">
        <div class="row">
            <div class="sectionTitle">
                <h2><span class="lightBg">Gallery</span></h2>
                <p>We are happy to share our experiences with you during the past years with our customers. We have a
                    Few photos and films from our tours and local guides all over Europe. Don't hesitate to consult with
                    our team and get your own experience, your own travel movie.</p>
            </div>
        </div>
        <div class="row">

            <?= \frontend\components\GalleryWidget::widget(['id' => \frontend\components\GalleryWidget::HOME_PAGE_GALLERY, 'type' => 'home-photo']); ?>
        </div>
        <div class="row">

            <?= \frontend\components\GalleryWidget::widget(['id' => \frontend\components\GalleryWidget::HOME_PAGE_GALLERY, 'type' => 'home-video']); ?>

        </div>
        <div class="row">

            <div class="col-md-4 col-xs-6  col-md-offset-5 col-xs-offset-3 ">
                <?= Html::a('See more', Url::to(['site/media']), ['class' => 'btn buttonCustomPrimary media-btn']) ?>
            </div>
        </div>
    </div>

</section>
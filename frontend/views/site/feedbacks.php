<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customer Testimonials';
$this->registerJs("   $(document).ready(function() {
  var owl = $('#client-feedbacks');
  owl.owlCarousel({
      items : 1, //10 items above 1000px browser width
      itemsDesktop : [1000,2], //5 items between 1000px and 901px
      itemsDesktopSmall : [900,1], // betweem 900px and 601px
      itemsTablet: [600,1], //2 items between 600 and 0
      itemsMobile : false, // itemsMobile disabled - inherit from itemsTablet option
       navigation: true,
       pagination: true,
       autoPlay: 8000,
        owl2row: true,
     
  });
});", yii\web\View::POS_END);
?>
<section class="pageTitle testimonials"">
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
                        'label' => 'Feedbacks',
                        'template' => "<li><b>{link}</b></li>\n", // template for this link only
                    ],
                ],
            ]);
            ?>
        </ol>
    </div>
</div>
<section class="whiteSection">
    <div class="container feedbacks">
        <div class="row">
            <div class="col-xs-12">
                <div class="sectionTitle">
                    <h2><span><?= $this->title; ?></span></h2>
                    <p>Here we update some of our customer feedbacks</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="client-feedbacks">

                    <!-- SINGLE FEEDBACK BOX-->
                    <?php
                    $count = 1;
                    foreach ($dataProvider as $key => $model) {
                        if ($count % 4 == 1) {
                            echo '<div class="row">
                        <div class="col-md-12">';
                        }
                        echo '<div class="feedback-box">
                  <div class="quote red-text">
                            <i class="fa fa-quote-left" aria-hidden="true"></i>
                        </div> 
        <div class="client-image">' .

                            Html::img('/uploads/feedbacks/thumbs_150x150/' . $model->images[0]->name) . '
            
                   
                       </div>
                    <div class="message">'
                            . $model->feedback_text . '
                    </div>
                    <div class="client-info">' . $model->name . '
                        </div> 
                        <div class="clearfix"></div>
                
                </div>';
                        if ($count % 4 == 0) {
                            echo "</div></div>";
                        }
                        $count++;
                    }

                    if ($count % 4 != 1) echo "</div>";

                    ?>

                </div>
            </div>
        </div>
    </div>

</section>
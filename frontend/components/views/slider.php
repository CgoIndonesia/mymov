<?php

use yii\helpers\Json;
use yii\web\View;
$data=Json::decode ($slider->content);
?>
<header id="myCarousel" class="carousel slide">
    <!-- Wrapper for Slides -->
    <div class="carousel-inner">
        <?php foreach ($data as $key => $slide):?>


        <?php
    $slide_data = array_filter($slide);
    if (!empty($slide_data['image'])) {
        $this->registerJs(' $(".banner'.$key.'").css({ "background-image": "url(/uploads/slider/'.$slide_data['image'].')" });', View::POS_END);
       if  ($key == 0 ? $active = "active" : $active = "slide");
        if (array_key_exists('title',$slide_data) ? $title = $slide_data['title'] : $title='');
        if (array_key_exists('description',$slide_data) ? $description = $slide_data['description'] : $description='');
echo '<div class="banner'.$key.' item '.$active.'">
       <div class="carousel-caption">
        <h1>'.$title.'</h1>
        <div class="clearfix"></div>
        <p>'.$description.'</p>
    </div>
    </div>';
    }
    ?>

        <?php endforeach;?>
    </div>


    <!-- Controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="icon-prev"></span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="icon-next"></span>
    </a>
</header>
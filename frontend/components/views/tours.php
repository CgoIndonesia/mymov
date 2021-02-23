<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="row isotopeContainer">

<?php foreach ($tours as $tour): ?>
            <div class="col-sm-4 isotopeSelector asia">
              <article class="">
                <figure>
                   <?php
                if (!empty($tour->images[0]->name)) {
                    echo Html::img('/uploads/tours/thumbs_350x220/' . $tour->images[0]->name);
                } ?>
                  <h4><?= $tour->name; ?></h4>
                  <div class="overlay-background">
                    <div class="inner"></div>
                  </div>
                  <div class="overlay">
                    <a class="fancybox-pop" href="<?= Url::to(['tours/view', 'id' => $tour->id]); ?>">

                    <div class="overlayInfo">
                      <h5>from <span><?= round($tour->price, 0); ?>
                &#8364;</span></h5>
                    </div>
                    </a>
                  </div>
                </figure>
              </article>
            </div>
               <?php endforeach; ?>
        </div>

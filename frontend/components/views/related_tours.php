<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>

<?php foreach ($tours as $tour): ?>

<div class="col-sm-4 col-xs-12">
    <div class="relatedItem">
      <?php echo !empty($tour->images[0]->name) ?  Html::img('/uploads/tours/thumbs_350x220/'.$tour->images[0]->name): [];?>
        <div class="maskingInfo">
            <h4><?= $tour->name; ?></h4>
            <p>From <?= round($tour->price, 0); ?>
                &#8364;</p>
            <?= Html::a('View more', Url::to(['tours/view', 'id' => $tour->id]), ['class'=>'btn buttonTransparent']);?>
        </div>
    </div>
</div>
<?php endforeach;?>

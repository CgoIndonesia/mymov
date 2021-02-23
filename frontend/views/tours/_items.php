<?php
/**
 * Created by PhpStorm.
 * User: ANDREW
 * Date: 12/9/2016
 * Time: 9:35 PM
 */
use yii\helpers\Html;
use yii\helpers\Url;

?>


<div class="media packagesList">
    <?php if (!empty($model->images[0]->name)) {
        echo '<a class="media-left"  href="'.Url::to(["tours/view", "id" => $model->id]).'">';

        echo Html::img('/uploads/tours/thumbs_350x270/' . $model->images[0]->name, ['class' => 'media-object']);
    }
    ?>
</a>
<div class="media-body">
    <div class="bodyLeft">
        <h4 class="media-heading"> <?= Html::a($model->name, Url::to(['tours/view', 'id' => $model->id])); ?></h4>

        <p><?= $model->short_description; ?></p>
        <ul class="list-inline detailsBtn">
            <li><span class="textInfo"><i class="fa fa-users"
              aria-hidden="true"></i> MAX MEMBERS <?= $model->maximum_members; ?></span>
          </li>
          <li><span class="textInfo"><i class="fa fa-clock-o"
              aria-hidden="true"></i> <?= $model->estimated_time . ' ' . $model::GetDurationType($model->duration_type); ?> </span>
          </li>
      </ul>
  </div>
  <div class="bodyRight">
    <div class="bookingDetails">
        <h2>From <?= round($model->price, 0); ?>
            &#8364;</h2>
            <p>Per Person</p>
            <?= Html::a('Details', Url::to(['tours/view', 'id' => $model->id]), ['class' => 'btn buttonTransparent clearfix']); ?>
        </div>
    </div>
</div>
</div>
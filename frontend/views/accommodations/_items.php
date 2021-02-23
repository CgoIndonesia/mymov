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

    <div class="col-sm-4 col-xs-12">
        <div class="thumbnail deals">
            <?php  if (!empty($model->images[0]->name)) {
                echo Html::a(Html::img('/uploads/accommodations/thumbs_370x270/' . $model->images[0]->name), Url::to(['accommodations/view', 'id' => $model->id]));
            }
            echo Html::a('', Url::to(['tours/view', 'id' => $model->id]),['class' => 'pageLink']);
            ?>

            <div class="caption">
                <h4><?= Html::a($model->name, Url::to(['accommodations/view', 'id' => $model->id]), ['class' =>'captionTitle']);?></h4>
                <p><?=$model->short_description; ?></p>
                <div class="detailsInfo">
                    <h5>
                        <span>Start From</span>
                        <?= round($model->price, 0); ?>
                        &#8364
                    </h5>
                    <ul class="list-inline detailsBtn">
                        <li><?= Html::a('Details', Url::to(['accommodations/view', 'id' => $model->id]), ['class' =>'btn buttonTransparent']);?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>




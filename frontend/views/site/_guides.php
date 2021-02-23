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

<div class="row guides-members">
    <div class="col-sm-4 col-xs-12 ">
        <div class="teamMember">
            <?php if (!empty($model->images[0]->name)) {

                echo Html::img('/uploads/guides/thumbs_350x273/' . $model->images[0]->name);
            }
            ?>
            <div class="memberName">
                <h4><?= $model->name; ?></h4>
                <p><?= $model->location; ?></p>
            </div>
            <div class="maskingArea">
                <h5>From <span><?= round($model->price, 0); ?>
                    &#8364;</span></h5>

            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xs-12">
        <p class="member-info"><?= $model->description; ?></p>

    </div>
    <div class="col-sm-2 col-xs-12">
    <div class="bookingDetails book-guide">
        <h4><span><?= round($model->price, 0); ?>
                &#8364;</span></h4>
        <?= Html::a('BOOK', Url::to(['site/contact']), ['class' => 'btn buttonTransparent clearfix']) ?>
    </div>
    </div>
</div>





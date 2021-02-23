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

 <div class="row">
            <div class="col-sm-4 col-xs-12">
                <div class="teamMember">
                   <?php if (!empty($model->images[0]->name)) {

                echo Html::img('/uploads/team/thumbs_640x500/' . $model->images[0]->name);
            }
            ?>
                    <div class="memberName">
                        <h4> <?= $model->name; ?></h4>
                        <p> <?= $model->position; ?></p>
                    </div>
                    <div class="maskingArea">
                        <ul class="list-inline">
                            <li><a href="<?= $model->facebook; ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="<?= $model->twitter; ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="<?= $model->google_plus; ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                            <li><a href="<?= $model->instagram; ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-8 col-xs-12">
                <h4><?= $model->name; ?></h4>
                <span class="member-info"><?= $model->description; ?></span>
        </div>
     </div>





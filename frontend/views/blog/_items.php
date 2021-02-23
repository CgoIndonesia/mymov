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
<section class="mainContentSection">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="media blogPostListItem">
                    <a class="media-left" href="<?= Url::to(['blog/view', 'id' => $model->id]); ?>">
                        <?php


                        if (isset($model->image->name)) {
                            if (file_exists(Yii::getAlias('@uploads/content/thumbs_570x370/' . $model->image->name))) {

                                echo Html::img('/uploads/content/thumbs_570x370/' . $model->image->name, ['class' => 'media-object']);
                            }
                        }

                        ?>
                    </a>
                    <div class="media-body">
                        <h4><?= Html::a($model->title, Url::to(['blog/view', 'id' => $model->id]), ['class' => 'blogTitle']); ?>
                        </h4>
                        <ul class="list-inline blogInfo">
                            <li><i class="fa fa-user" aria-hidden="true"></i><?= $model->author; ?></li>
                            <li><i class="fa fa-calendar"
                                    aria-hidden="true"></i><?= \Yii::$app->formatter->asDate($model->create_time, 'long'); ?>
                            </li>
                        </ul>
                        <p><?php

                            $description = strip_tags($model->content);
                            if (strlen($description) > 600) {
                                $stringCut = substr($description, 0, 600);
                                $description = substr($stringCut, 0, strrpos($stringCut, ' ')) . '...';
                            }
                            echo $description;

                            ?></p>
                        <?= Html::a('View post', Url::to(['blog/view', 'id' => $model->id]), ['class' => 'btn buttonTransparent']); ?>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>
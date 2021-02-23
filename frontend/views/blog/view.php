<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model common\models\Tours */

$this->title = $model->title;

?>
<section class="pageTitle blog">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="titleTable">
                    <div class="titleTableInner">
                        <div class="pageTitleInfo">
                            <h1><?=$this->title;?></h1>
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
                        'label' => 'Posts',
                        'template' => "<li><b>{link}</b></li>\n",
                        'url' => Url::to(['blog/index']) // template for this link only
                    ],
                    [
                        'label' => $model->title,
                        'template' => "<li><b>{link}</b></li>\n", // template for this link only
                    ],
                ],
            ]);
            ?>
        </ol>
    </div>
</div>
<section class="mainContentSection blogSidebar mainContent">
    <div class="container">
        <div class="row">
            <div class="col-sm-3 col-sm-push-9 col-xs-12">
                <aside>
                    <?= \frontend\components\RelatedPosts::widget(['current_item_id' => $model->id]) ?>
                </aside>
            </div>
            <div class="col-sm-9 col-sm-pull-3 col-xs-12">
                <div class="thumbnail blogSinglePost">
                    <?php
                    if (isset($model->image->name)) {
                       echo Html::img('/uploads/content/thumbs_870x420/' . $model->image->name);
                    }
                    ?>
                    <div class="caption">
                        <h2><?= $model->title; ?></h2>
                        <ul class="list-inline blogInfo">
                            <li><i class="fa fa-user" aria-hidden="true"></i><?= $model->author; ?></li>
                            <li><i class="fa fa-calendar"
                                    aria-hidden="true"></i><?= \Yii::$app->formatter->asDate($model->create_time, 'long'); ?>
                            </li>
                        </ul>
                        <p><?= $model->content; ?></p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
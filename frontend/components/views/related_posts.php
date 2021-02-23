<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div role="tabpanel" class="tabArea">

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="recent">
            <?php foreach ($posts as $key => $post): ?>
                <div class="media">
                    <a class="media-left" href="<?= Url::to(['blog/view', 'id' => $post->id]); ?>">
                        <?php

                        if (isset($post->image->name)) {
                            if (file_exists(Yii::getAlias('@uploads/content/thumbs_570x370/' . $post->image->name))) {

                                echo Html::img('/uploads/content/thumbs_570x370/' . $post->image->name, ['class' => 'media-object']);
                            }
                        }
                        ?>
                    </a>
                    <div class="media-body">
                        <h4> <?= Html::a($post->title, Url::to(['blog/view', 'id' => $post->id]), ['class' => 'media-heading']); ?></h4>
                        <p><i class="fa fa-calendar"
                              aria-hidden="true"></i><?= \Yii::$app->formatter->asDate($post->create_time, 'long'); ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>
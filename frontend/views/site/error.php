<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>

<section class="notFoundContent">
    <div class="container">
        <div class="row">
    <?= Html::img('/img/not-found.png'); ?>
    <h4>Oops! The page you are looking for could not be found!</h4>
    <p>Please try searching again</p>
    </div>
        </div>
</section>

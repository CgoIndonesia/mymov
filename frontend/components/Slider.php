<?php

namespace frontend\components;

use yii\base\Widget;
use common\models\Blocks;


class Slider extends Widget
{
    public $slider;

    public function init()

    {
        parent::init();
        $this->slider = Blocks::find()
            ->where('name=:name', [':name' => Blocks::BLOCK_SLIDER])
            ->orderBy('id')
            ->One();
    }


    public function run()
    {

        return $this->render('slider', ['slider' => $this->slider]);

    }

}
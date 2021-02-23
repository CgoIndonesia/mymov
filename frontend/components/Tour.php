<?php

namespace frontend\components;

use yii\base\Widget;
use common\models\Tours;


class Tour extends Widget
{
    public $tours;

    public function init()

    {
        parent::init();
        $this->tours = Tours::find()
            ->where('status=:status', [':status' => Tours::STATUS_ACTIVE])
            ->andwhere('ishome=:ishome', [':ishome' => 1])
            ->orderBy('id')
            ->all();
    }


    public function run()
    {

        return $this->render('tours', ['tours' => $this->tours]);

    }

}
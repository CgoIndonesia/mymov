<?php

namespace frontend\components;

use yii\base\Widget;
use common\models\Tours;
use yii\db\Expression;

class RelatedTours extends Widget
{
    public $tours;
    public $current_item_id;

    public function init()

    {
        parent::init();
        $this->tours = Tours::find()
            ->where('status=:status', [':status' => Tours::STATUS_ACTIVE])
            ->andwhere('id!=:id',[':id' =>$this->current_item_id])
            ->orderBy(new Expression('rand()'))
            ->limit(3)
            ->all();
    }


    public function run()
    {

        return $this->render('related_tours', ['tours' => $this->tours]);

    }

}
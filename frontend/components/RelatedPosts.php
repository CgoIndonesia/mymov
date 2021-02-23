<?php

namespace frontend\components;

use yii\base\Widget;
use common\models\Blog;
use yii\db\Expression;

class RelatedPosts extends Widget
{
    public $posts;
    public $current_item_id;

    public function init()

    {
        parent::init();
        $this->posts = Blog::find()
            ->where('status=:status', [':status' => Blog::STATUS_ACTIVE])
            ->andwhere('id!=:id',[':id' =>$this->current_item_id])
            ->orderBy('id')
            ->limit(4)
            ->all();
    }


    public function run()
    {

        return $this->render('related_posts', ['posts' => $this->posts]);

    }

}
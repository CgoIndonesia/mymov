<?php

namespace frontend\components;

use yii\base\Widget;
use common\models\Gallery;


class GalleryWidget extends Widget
{

    const HOME_PAGE_GALLERY = 1;
    const MYMOVIE_PAGE_GALLERY = 2;
    const MEDIA_PAGE_GALLERY = 3;



    public $gallery;
    public $id;
    public $type;

    public function init()

    {
        parent::init();
        $this->gallery = Gallery::find()->where(['id' => $this->id])->one();
    }


    public function run()
    {
        switch ($this->type) {
            case 'home-photo':
                return $this->render('gallery-home-photo', ['gallery' => $this->gallery]);
                break;
            case 'home-video':
                return $this->render('gallery-home-video', ['gallery' => $this->gallery]);
                break;
            case 'media-photo':
                return $this->render('gallery-media-photo', ['gallery' => $this->gallery]);
                break;
            case 'media-video':
                return $this->render('gallery-media-video', ['gallery' => $this->gallery]);
                break;
            case 'mymovie-photo':
                return $this->render('gallery-mymovie-photo', ['gallery' => $this->gallery]);
                break;
            case 'mymovie-video':
                return $this->render('gallery-mymovie-video', ['gallery' => $this->gallery]);
                break;

        }

    }

}
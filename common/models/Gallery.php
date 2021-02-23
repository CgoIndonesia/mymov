<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gallery".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $source
 * @property integer $source_type
 * @property string $seo_title
 * @property string $seo_description
 * @property string $seo_keywords
 */
class Gallery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */



    public static function tableName()
    {
        return 'gallery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
    
            [['name'], 'string', 'max' => 255],
        ];
    }


     public function getPhotos()
    {
        return $this->hasMany(GalleryImages::className(), ['gallery_id' => 'id'])->orderBy(['sort_order' => SORT_ASC]);
    }
    public function getVideos()
    {
        return $this->hasMany(GalleryVideos::className(), ['gallery_id' => 'id'])->orderBy(['sort_order' => SORT_ASC]);
    }



    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        
        ];
    }
}

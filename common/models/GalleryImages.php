<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gallery_sources".
 *
 * @property integer $id
 * @property string $image_name
 * @property string $image_description
 * @property string $video_name
 * @property string $video_description
 * @property string $video
 * @property string $image
 */
class GalleryImages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $file;

    public static function tableName()
    {
        return 'gallery_images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'image'], 'string'],
            [['gallery_id'], 'integer'],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['name', 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'image' => 'Image',
          
        ];
    }
}

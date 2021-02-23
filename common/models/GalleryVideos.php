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
class GalleryVideos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public static function tableName()
    {
        return 'gallery_videos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'video'], 'string'],
            [['gallery_id'], 'integer'],
            [['name'], 'string', 'max' => 500],
            [['description'], 'string', 'max' => 800],
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
            'video' => 'video',
          
        ];
    }
}

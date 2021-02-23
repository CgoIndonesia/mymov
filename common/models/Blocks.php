<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "blocks".
 *
 * @property integer $id
 * @property string $name
 * @property string $title
 * @property string $content
 */
class Blocks extends \yii\db\ActiveRecord
{
    
    const BLOCK_SLIDER = 'slider';
    const BLOCK_PRICELIST = 'pricelist';


    public $files;
    public $img_desc;

    public static function tableName()
    {
        return 'blocks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['name', 'title'], 'string', 'max' => 255],

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
            'title' => 'Title',
        ];
    }
}

<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "images".
 *
 * @property integer $id
 * @property string $name
 * @property integer $ismain
 * @property integer $source
 * @property integer $source_id
 */
class Images extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'source', 'source_id'], 'required'],
            [['ismain', 'source', 'source_id'], 'integer'],
            [['name'], 'string', 'max' => 455],
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
            'ismain' => 'Ismain',
            'source' => 'Source',
            'source_id' => 'Source ID',
        ];
    }
}

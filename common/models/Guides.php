<?php

namespace common\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "guides".
 *
 * @property integer $id
 * @property integer $create_time
 * @property integer $update_time
 * @property string $name
 * @property string $alias
 * @property string $description
 * @property string $location
 * @property string $price
 * @property string $seo_title
 * @property string $seo_description
 * @property string $seo_keywords
 */
class Guides extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    const GUIDE_IMAGE = 4;
    const ORDER_TYPE = 3;

    public static function tableName()
    {
        return 'guides';
    }

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'name',
                'slugAttribute' => 'alias',
                'ensureUnique' => true,
            ],

            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_time',
                'updatedAtAttribute' => 'update_time',

            ],

        ];

    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'price', 'location'], 'required'],
            [['create_time', 'update_time'], 'integer'],
            [['description', 'seo_description'], 'string'],
            [['price'], 'number'],
            [['name', 'alias', 'location', 'seo_title', 'seo_keywords'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'name' => 'Name',
            'alias' => 'Alias',
            'description' => 'Description',
            'location' => 'Location',
            'price' => 'Price',
            'seo_title' => 'Seo Title',
            'seo_description' => 'Seo Description',
            'seo_keywords' => 'Seo Keywords',
        ];
    }

    public function getImages()
    {
        return $this->hasMany(Images::className(), ['source_id' => 'id'])->where('source = :source', [':source' => self::GUIDE_IMAGE]);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            if ((empty($this->seo_title))) {

                $this->seo_title = $this->name;
            }
            return true;
        } else {
            return false;
        }

    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);


        if (\Yii::$app->session['upload'] !== null) {
            foreach (\Yii::$app->session['upload'] as $image) {
                $images = new Images;
                $images->name = $image;
                $images->ismain = 0;
                $images->source = self::GUIDE_IMAGE;
                $images->source_id = $this->id;
                if ($images->save()) {
                    unset(\Yii::$app->session['upload']);
                }
            }
        }
    }

    public function afterDelete()
    {
        parent::afterDelete();

        $images = Images::find()->where(['source_id' => $this->id, 'source' => self::GUIDE_IMAGE])->all();
        foreach ($images as $image) {
            $image->delete();
            if (file_exists(Yii::getAlias('@uploads/guides/' . $image->name))) {
                $path = Yii::getAlias('@uploads/guides/' . $image->name);
                unlink($path);
            }
            if (file_exists(Yii::getAlias('@uploads/guides/thumbs_350x273/' . $image->name))) {
                $path_thumbs_350x273 = Yii::getAlias('@uploads/guides/thumbs_350x273/' . $image->name);
                unlink($path_thumbs_350x273);
            }
        }
    }
}

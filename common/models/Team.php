<?php

namespace common\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "team.
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
class Team extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    const TEAM_IMAGE = 6;
    const ORDER_TYPE = 4;

    public static function tableName()
    {
        return 'team';
    }

    public function behaviors()
    {
        return [
         
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
            [['name', 'description', 'position'], 'required'],
            [['create_time', 'update_time'], 'integer'],
            [['description', 'seo_description'], 'string'],
            [['name','seo_title', 'seo_keywords','facebook','instagram','google_plus','twitter'], 'string', 'max' => 255],
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
            'description' => 'Description',
            'position' => 'Position',
            'facebook' => 'Facebook',
            'google_plus' => 'Google +',
            'twitter' => 'Twitter',
            'instagram' => 'Instagram',
            'seo_title' => 'Seo Title',
            'seo_description' => 'Seo Description',
            'seo_keywords' => 'Seo Keywords',
        ];
    }

    public function getImages()
    {
        return $this->hasMany(Images::className(), ['source_id' => 'id'])->where('source = :source', [':source' => self::TEAM_IMAGE]);
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
                $images->source = self::TEAM_IMAGE;
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

        $images = Images::find()->where(['source_id' => $this->id, 'source' => self::TEAM_IMAGE])->all();
        foreach ($images as $image) {
            $image->delete();
            if (file_exists(Yii::getAlias('@uploads/team/' . $image->name))) {
                $path = Yii::getAlias('@uploads/team/' . $image->name);
                unlink($path);
            }
            if (file_exists(Yii::getAlias('@uploads/team/thumbs_640x500/' . $image->name))) {
                $path_thumbs_640x500 = Yii::getAlias('@uploads/team/thumbs_640x500/' . $image->name);
                unlink($path_thumbs_640x500);
            }
        }
    }
}
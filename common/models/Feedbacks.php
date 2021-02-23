<?php

namespace common\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "feedbacks".
 *
 * @property integer $id
 * @property integer $create_time
 * @property integer $update_time
 * @property string $name
 * @property string $alias
 * @property string $feedback_text
 * @property string $seo_title
 * @property string $seo_description
 * @property string $seo_keywords
 */
class Feedbacks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
     const FEEDBACK_IMAGE = 5;

    public static function tableName()
    {
        return 'feedbacks';
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
            [['name', 'feedback_text'], 'required'],
            [['create_time', 'update_time'], 'integer'],
            [['feedback_text', 'seo_description'], 'string'],
            [['name', 'alias', 'seo_title', 'seo_keywords'], 'string', 'max' => 255],
        ];
    }
      public function getImages()
    {
        return $this->hasMany(Images::className(), ['source_id' => 'id'])->where('source = :source', [':source' => self::FEEDBACK_IMAGE]);
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
                $images->source = self::FEEDBACK_IMAGE;
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

        $images = Images::find()->where(['source_id' => $this->id, 'source' => self::FEEDBACK_IMAGE])->all();
        foreach ($images as $image) {
            $image->delete();
            if (file_exists(Yii::getAlias('@uploads/feedbacks/' . $image->name))) {
                $path = Yii::getAlias('@uploads/feedbacks/' . $image->name);
                unlink($path);
            }
            if (file_exists(Yii::getAlias('@uploads/feedbacks/thumbs_350x273/' . $image->name))) {
                $path_thumbs_350x273 = Yii::getAlias('@uploads/feedbacks/thumbs_350x273/' . $image->name);
                unlink($path_thumbs_350x273);
            }
        }
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
            'feedback_text' => 'Feedback Text',
            'seo_title' => 'Seo Title',
            'seo_description' => 'Seo Description',
            'seo_keywords' => 'Seo Keywords',
        ];
    }
}

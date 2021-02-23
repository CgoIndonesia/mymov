<?php

namespace common\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use common\models\Images;
use yii\web\UploadedFile;

/**
 * This is the model class for table "blog".
 *
 * @property integer $id
 * @property string $title
 * @property string $alias
 * @property string $content
 * @property string $seo_title
 * @property string $seo_description
 * @property string $seo_keywords
 * @property string $create_time
 * @property string $update_time
 * @property integer $status
 * @property integer $cache
 * @property integer $author
 * @property integer $category_id
 */
class Blog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;
    const POST_IMAGE = 1;
    const ORDER_TYPE = 5;
    public $file;

    public static function tableName()
    {
        return 'blog';
    }

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'slugAttribute' => 'alias',
                'ensureUnique' => true,
            ],

            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_time',
                'updatedAtAttribute' => 'update_time',
                'value' => new Expression('NOW()'),
            ],

        ];

    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'status', 'cache', 'author', 'category_id'], 'required'],
            [['content', 'seo_description'], 'string'],
            [['create_time', 'update_time'], 'safe'],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['status', 'cache', 'category_id'], 'integer'],
            [['title', 'alias', 'seo_title', 'seo_keywords'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'alias' => 'Alias',
            'file' => 'Image',
            'content' => 'Content',
            'seo_title' => 'Title',
            'seo_description' => 'Description',
            'seo_keywords' => 'Keywords',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'status' => 'Status',
            'cache' => 'Cache',
            'author' => 'Author',
            'category_id' => 'Category',
        ];
    }

   
    public function getImages()
    {
        return $this->hasMany(Images::className(), ['source_id' => 'id'])->where('source = :source', [':source' => self::POST_IMAGE ]);
    }
    public function getImage()
    {
        return $this->hasOne(Images::className(), ['source_id' => 'id'])->where('source = :source', [':source' => self::POST_IMAGE ])->orderBy(['id' => SORT_DESC]);
    }
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            if ((empty($this->seo_title))) {

                $this->seo_title = $this->title;
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
                $images->source = self::POST_IMAGE;
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

        $images = Images::find()->where(['source_id' => $this->id, 'source' => self::POST_IMAGE])->all();
        foreach ($images as $image) {
            $image->delete();
            if (file_exists(Yii::getAlias('@uploads/content/' . $image->name))) {
                $path = Yii::getAlias('@uploads/content/' . $image->name);
                $path_thumbs_570x370 = Yii::getAlias('@uploads/content/thumbs_570x370/' . $image->name);
                $path_thumbs_870x420 = Yii::getAlias('@uploads/content/thumbs_870x420/' . $image->name);
                unlink($path);
                if (file_exists(Yii::getAlias($path_thumbs_570x370))) {
                    unlink($path_thumbs_570x370);
                }
                if (file_exists(Yii::getAlias($path_thumbs_570x370))) {
                    unlink($path_thumbs_870x420);
                }
            }
        }
    }

    static function GetPostStatus($status)
    {
        $items = [self::STATUS_ACTIVE => 'Active', self::STATUS_DELETED => 'Not Active'];
        return $items[$status];
    }


}
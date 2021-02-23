<?php

namespace common\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;


/**
 * This is the model class for table "tours".
 *
 * @property integer $id
 * @property integer $create_time
 * @property integer $update_time
 * @property string $name
 * @property string $description
 * @property string $price
 * @property string $features
 * @property string $deposit_address
 * @property integer $status
 * @property string $seo_title
 * @property string $seo_description
 * @property string $seo_keywords
 */
class Accommodations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;
    const ACCOMMODATION_IMAGE = 3;
    const ORDER_TYPE = 1;


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

    public static function tableName()
    {
        return 'accommodations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'short_description','price', 'status', 'video'], 'required'],
            [['create_time', 'update_time', 'status'], 'integer'],
            [['description', 'seo_description', 'video'], 'string'],
            [['price'], 'number'],
            [['name', 'seo_title', 'seo_keywords'], 'string', 'max' => 255],
            [['short_description'], 'string', 'max' => 200],
        ];
    }

    public function getImages()
    {
        return $this->hasMany(Images::className(), ['source_id' => 'id'])->where('source = :source', [':source' => self::ACCOMMODATION_IMAGE]);
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
            'short_description' => 'Short Description',
            'video' => 'Youtube Link',
            'price' => 'Price',
            'features' => 'Features',
            'status' => 'Status',
            'seo_title' => 'Seo Title',
            'seo_description' => 'Seo Description',
            'seo_keywords' => 'Seo Keywords',
        ];
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
                $images->source = self::ACCOMMODATION_IMAGE;
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

        $images = Images::find()->where(['source_id' => $this->id, 'source' => self::ACCOMMODATION_IMAGE])->all();
        foreach ($images as $image) {
            $image->delete();
            if (file_exists(Yii::getAlias('@uploads/accommodations/' . $image->name))) {
                $path = Yii::getAlias('@uploads/accommodations/' . $image->name);
                $path_thumbs_370x270 = Yii::getAlias('@uploads/tours/thumbs_370x270/' . $image->name);
                unlink($path);
                if (file_exists(Yii::getAlias('@uploads/accommodations/thumbs_370x270/' . $image->name))) {
                    unlink($path_thumbs_370x270);
                }
            }
        }
    }

    static function GetAccommodationStatus($status)
    {
        $items = [self::STATUS_ACTIVE => 'Active', self::STATUS_DELETED => 'Not Active'];
        return $items[$status];
    }

    static function GetAccommodationsFeatures($key)
    {
        $features = [

            0 => ['label' => 'Apartment', 'description' => '2 rooms apartment', 'icon' => 'fa fa-home'],
            1 => ['label' => 'Wifi', 'description' => 'Wifi available', 'icon' => 'fa fa-wifi'],
            2 => ['label' => 'Courtyard', 'description' => 'Beautiful and quiet courtyard outdoor.', 'icon' => 'fa fa-sun-o'],
            3 => ['label' => 'Kitchen', 'description' => 'Fully equipped kitchen. all tools included.', 'icon' => 'fa fa-spoon'],
            4 => ['label' => 'Raid', 'description' => '5 rooms raid', 'icon' => 'fa fa-clock-o'],
            5 => ['label' => 'Pool', 'description' => 'Beautiful and quiet interior pool + terrace.', 'icon' => 'fa fa-umbrella'],
            6 => ['label' => 'Private Room', 'description' => 'Private room available', 'icon' => 'fa fa-home'],
            7 => ['label' => 'Private Double Room', 'description' => 'Private room available', 'icon' => 'fa fa-home'],
            8 => ['label' => '1 Room Apartment', 'description' => '1 room available', 'icon' => 'fa fa-home'],
            9 => ['label' => '2 Room Apartment', 'description' => '2 rooms available', 'icon' => 'fa fa-home'],
            10 => ['label' => '3 Room Apartment', 'description' => '3 rooms available', 'icon' => 'fa fa-home'],
            11 => ['label' => '4 Room Apartment', 'description' => '4 rooms available', 'icon' => 'fa fa-home'],
            12 => ['label' => '5 Room Apartment', 'description' => '5 rooms available', 'icon' => 'fa fa-home'],
            13 => ['label' => 'Pension', 'description' => '5 rooms country house', 'icon' => 'fa fa-gamepad'],

        ];
        if (isset($key)) {
            return $features[$key];
        } else {
            return $features;

        }
    }


}

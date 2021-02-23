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
class Tours extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;
    const TOUR_IMAGE = 2;
    const ORDER_TYPE = 2;


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
        return 'tours';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        [['name', 'description','short_description','price', 'status', 'ishome','maximum_members','local_guides','video','estimated_time','duration_type'], 'required'],
        [['create_time', 'update_time', 'status','maximum_members','local_guides','estimated_time','duration_type'], 'integer'],
        [['description','short_description','seo_description','video'], 'string'],
        [['price'], 'number'],
        [['name', 'seo_title', 'seo_keywords'], 'string', 'max' => 255],
        [['short_description'], 'string', 'max' => 500],
        ];
    }

    public function getImages()
    {
        return $this->hasMany(Images::className(), ['source_id' => 'id'])->where('source = :source', [':source' => self::TOUR_IMAGE]);
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
        'maximum_members' => 'Maximum Members',
        'local_guides' => 'Local Guides',
        'duration_type' => 'Type',
        'estimated_time' => 'Estimated Time',
        'video' => 'Youtube Link',
        'price' => 'Price',
        'ishome' => 'Display in Home Page',
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
                $images->source = self::TOUR_IMAGE;
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

        $images = Images::find()->where(['source_id' => $this->id, 'source' => self::TOUR_IMAGE])->all();
        foreach ($images as $image) {
            $image->delete();
            if (file_exists(Yii::getAlias('@uploads/tours/' . $image->name))) {
                $path = Yii::getAlias('@uploads/tours/' . $image->name);
                $path_thumbs_350x220 = Yii::getAlias('@uploads/tours/thumbs_350x220/' . $image->name);
                $path_thumbs_350x270 = Yii::getAlias('@uploads/tours/thumbs_350x270/' . $image->name);
                unlink($path);
                if (file_exists(Yii::getAlias('@uploads/tours/thumbs_350x220/' . $image->name))) {
                    unlink($path_thumbs_350x220);
                }
                if (file_exists(Yii::getAlias('@uploads/tours/thumbs_350x270/' . $image->name))) {
                    unlink($path_thumbs_350x270);
                }

            }
        }
    }

    static function GetTourStatus($status)
    {
        $items = [self::STATUS_ACTIVE => 'Active', self::STATUS_DELETED => 'Not Active'];
        return $items[$status];
    }
    static function GetDurationType($type)
    {
        $items = [1 => 'Hour(s)', 2 => 'Day(s)'];
        if ($type != null) {
            return $items[$type];
        }
        else return $items;
    }

    static function GetTourFeatures($key)
    {
        $features = [

        0 => ['label' => 'Meeting point', 'description' => 'Meeting point according to the tour', 'icon' => 'fa fa-users'],
        1 => ['label' => 'Tricks & Tips', 'description' => 'Special tips & tricks about Barcelona', 'icon' => 'fa fa-comments'],
        2 => ['label' => 'Meals on the way', 'description' => 'Try and taste local food from real local and most authentic spots', 'icon' => 'fa fa-cutlery'],
        3 => ['label' => 'Eco tour', 'description' => 'Consuming eco energy and not poluting the environment. Green tour', 'icon' => 'fa fa-leaf'],
        4 => ['label' => 'Night Tour', 'description' => 'Discover the city by night', 'icon' => 'fa fa-clock-o'],
        5 => ['label' => 'Olympic port', 'description' => 'Olympic port and its secrets', 'icon' => 'fa fa-ship'],
        6 => ['label' => 'Suprises', 'description' => 'In such a tour you will always receive some suprises. Just be ready', 'icon' => 'fa fa-gift'],
        7 => ['label' => 'Entertainment', 'description' => 'Great guide and fully prepared to satisfy any of your demands', 'icon' => 'fa fa-smile-o'],
        8 => ['label' => 'Pick up/drop of', 'description' => 'We pick you up and drop of at your location', 'icon' => 'fa fa-home'],
        9 => ['label' => 'Diving trial', 'description' => 'Free diving trial in our local diving center', 'icon' => 'fa fa-ship'],
        10 => ['label' => 'Lunch', 'description' => 'Taste local food in one of the most traditional spots', 'icon' => 'fa fa-cutlery'],
        11 => ['label' => 'Hiking in some unique spots', 'description' => 'During our tour we will hike and discover some', 'icon' => 'fa fa-futbol-o'],
        12 => ['label' => 'Private Driver', 'description' => 'Professional private driver', 'icon' => 'fa fa-car'],
        13 => ['label' => 'Islands tour informations', 'description' => 'Accurate island informations', 'icon' => 'fa fa-info'],
        14 => ['label' => 'Photography', 'description' => 'Photography assistance during the tour', 'icon' => 'fa fa-camera'],
        15 => ['label' => 'Camel ride', 'description' => 'Enjoy the experince to ride a camel in the desert', 'icon' => 'fa fa-tripadvisor'],
        16 => ['label' => 'Dinner & Breakfast', 'description' => 'Local dinner and breakfast', 'icon' => 'fa fa-cutlery'],
        17 => ['label' => 'Sandboarding', 'description' => 'Unique activitu you must do it 1 in lifetime', 'icon' => 'fa fa-thumbs-up'],
        18 => ['label' => '4x4', 'description' => '4x4 car cross the dunes of desert Sahara', 'icon' => 'fa fa-car'],
        19 => ['label' => 'Accommodation', 'description' => 'Hot shower and accommodation', 'icon' => 'fa fa-building'],
        20 => ['label' => 'Walking Tour', 'description' => 'We will move around and enjoy the beautiful city by walk', 'icon' => 'fa fa-street-view'],
        21 => ['label' => 'First GPS guide', 'description' => 'Unique dog Sanka will be your GPS during the tour', 'icon' => 'fa fa-star'],
        22 => ['label' => 'Private guide', 'description' => 'Private local guide will take you around', 'icon' => 'fa fa-user'],
        23 => ['label' => 'Handcrafts with leather bags', 'description' => 'Discover how are made the leather bags from craft', 'icon' => 'fa fa-briefcase'],
        24 => ['label' => 'Family experince', 'description' => 'Experince the real family life sharing tea and food', 'icon' => 'fa fa-user-circle'],
        25 => ['label' => 'Ceramic activities', 'description' => 'Visit and practice unique activity with the locals', 'icon' => 'fa fa-gavel'],
        26 => ['label' => 'Airport Pick up', 'description' => 'Airport pick up possibe on request at any time of the..', 'icon' => 'fa fa-plane'],
        27 => ['label' => 'Wine tasting', 'description' => 'Enjoy the best wines in the world.Tuscany wines', 'icon' => 'fa fa-smile-o'],
        28 => ['label' => 'Landscape therapy', 'description' => 'Beautiful landscape of Tuscany could be endless', 'icon' => 'fa fa-heart'],
        29 => ['label' => 'Meet the artist', 'description' => 'Upon your request we can organise a meeting with an artist', 'icon' => 'fa fa-user-plus'],
        ];
        if (isset($key)) {
            return $features[$key];
        } else {
            return $features;

        }
    }


}

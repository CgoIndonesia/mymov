<?php

namespace common\models;

use Yii;
use wbraganca\behaviors\NestedSetBehavior;
use wbraganca\behaviors\NestedSetQuery;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "categories".
 *
 * @property integer $id
 * @property integer $left
 * @property integer $right
 * @property integer $root
 * @property integer $level
 * @property string $title
 * @property string $alias
 * @property string $seo_title
 * @property string $seo_description
 * @property string $seo_keywords
 * @property integer $status
 * @property integer $order
 * @property integer $type
 * @property integer $cache
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;
    public $parent;

    public static function tableName()
    {
        return 'categories';
    }

    public function behaviors()
    {
        return [
            'nested' => [
                'class' => NestedSetBehavior::className(),
                'hasManyRoots' => true,
                'idAttribute' => 'id',
                'rootAttribute' => 'root',
                'leftAttribute' => 'left',
                'rightAttribute' => 'right',
                'levelAttribute' => 'level',
            ],
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'slugAttribute' => 'alias',
                'ensureUnique' => true,
            ]
        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'status', 'cache'], 'required'],
            [['left', 'right', 'root', 'level', 'status', 'order', 'type', 'cache', 'parent'], 'integer'],
            [['seo_description'], 'string'],
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
            'parent' => 'Parent',
            'title' => 'Title',
            'alias' => 'Alias',
            'seo_title' => 'Title',
            'seo_description' => 'Description',
            'seo_keywords' => 'Keywords',
            'status' => 'Status',
            'order' => 'Order',
            'type' => 'Type',
            'cache' => 'Cache',
        ];
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

    public function getCategories()
    {
        $categories = Categories::find()->where('level=:status', [':level' => 1])->andwhere('status=:status', [':status' => 1])->orderBy('root', 'left')->all();
        $category_tree = [];
        foreach ($categories as $key => $category) {


            $category_obj = [
                'title' => $category->title,
                'key' => $category->id,
            ];
            $category_tree[$key] = $category_obj;
            $children = $category->children()->andwhere('status=:status', [':status' => 1])->all();

            if ($children) {
                $category_tree[$key]['children'] = $this->getChildren($children);
                $category_tree[$key]['folder'] = true;
            }
        }

        return $category_tree;
    }

    private function getChildren($children)
    {
        $result = [];
        foreach ($children as $i => $child) {
            $category_r = [
                'title' => $child->title,
                'key' => $child->id,

            ];
            $result[$i] = $category_r;
            $new_children = $child->children()->andwhere('status=:status', [':status' => 1])->all();
            if ($new_children) {
                $result[$i]['children'] = $this->getChildren($new_children);
                $result[$i]['folder'] = true;
            }
        }
        return $result;
    }

    static function GetUserStatus($status)
    {
        $items = [self::STATUS_ACTIVE => 'Active', self::STATUS_DELETED => 'Not Active'];
        return $items[$status];
    }
}

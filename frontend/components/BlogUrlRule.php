<?php
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 8/19/2016
 * Time: 10:56 AM
 */

namespace app\components;

use common\models\Blog;
use yii\helpers\ArrayHelper;
use yii\web\UrlRuleInterface;
use yii\base\Object;

class BlogUrlRule extends Object implements UrlRuleInterface
{

    public $indexedByAlias;
    public $indexedById;

    public function init()
    {

        $posts = Blog::find()->indexBy('id')->all();
        $this->indexedById = ArrayHelper::map($posts, 'id', 'alias');
        $this->indexedByAlias = array_flip($this->indexedById);

    }

    public function createUrl($manager, $route, $params)
    {
        if ($route === 'blog/view') {
            if (isset($params['id'])) {
                $id = ArrayHelper::remove($params, 'id');
                if (isset($this->indexedById[$id])) {
                    $prefix = 'blog/';
                    return "{$prefix}{$this->indexedById[$id]}";
                }
            }
        }
        return false;  // this rule does not apply
    }

    public function parseRequest($manager, $request)
    {
        $path = explode('/', $request->getPathInfo());
        if (isset ($path[1]) AND $path[0] == 'blog') {
            $alias = $path[1];
            if (isset($this->indexedByAlias[$alias])) {
                return ['blog/view', ['id' => $this->indexedByAlias[$alias]]];
            }
            return false;
        }
        return false;  // this rule does not apply
    }

    public function __wakeup()
    {
        $this->init();
    }
}
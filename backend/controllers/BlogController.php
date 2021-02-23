<?php

namespace backend\controllers;

use Yii;
use common\models\Blog;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\UploadedFile;
use common\models\Order;

/**
 * BlogController implements the CRUD actions for Blog model.
 */
class BlogController extends Controller
{
    /**
     * @inheritdoc
     */
       public function actions()
{

    return [
        'browse-images' => [
            'class' => 'bajadev\ckeditor\actions\BrowseAction',
            'url' => Yii::$app->params['frontendUrl'].'/uploads/content/',
            'path' => '@uploads/content/',
        ],
        'upload-images' => [
            'class' => 'bajadev\ckeditor\actions\UploadAction',
            'url' => Yii::$app->params['frontendUrl'].'/uploads/content/',
            'path' => '@uploads/content/',
        ],
    ];
}

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Blog models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Blog::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Blog model.
     * @param integer $id
     * @return mixed
     */


    /**
     * Creates a new Blog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Blog();
        $model->status = 1;
        $model->cache = 1;
        $model->category_id = 1;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['index']);
        } else {
            unset(\Yii::$app->session['upload']);
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Blog model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        foreach ($model->images as $image) {
            if (isset($image->name)) {
                if (file_exists(Yii::getAlias('@uploads/content/thumbs_570x370/' . $image->name))) {
                    $initialPreview = Yii::$app->params['frontendUrl'].'uploads/content/' . $image->name;
    
                    $initialPreviewConfig [] = [
                        'caption' => $image->name, 'width' => '120px', 'url' => Url::to(['/file/delete']), 'key' => $image->id, 'extra' => ['path' => Yii::getAlias('@uploads/content/' . $image->name), 'filename_in_db' => $image->name, 'folder' => 'content'],
                    ];
                }
            }
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            return $this->redirect(['index']);
        } else {
            unset(\Yii::$app->session['upload']);
            return $this->render('update', [
                'model' => $model,
                'initialPreview' => !empty($initialPreview) ? $initialPreview : [],
                'initialPreviewConfig' => !empty($initialPreviewConfig) ? $initialPreviewConfig : [],
            ]);
        }
    }

    /**
     * Deletes an existing Blog model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */

    public function actionOrder()
    {
        $model = Order::find()->where(['source_type' => Blog::ORDER_TYPE])->one();
        $posts = Blog::find()->all();

        foreach ($posts as $post) {

            $posts_id [] = $post->id;
            $items [$post->id] = ['content' => $post->title];
        }

        $saved_order = explode(',', $model->order);
        if ($model->order) {

            $result = array_diff($posts_id, $saved_order);
            if ($result) {
                $result = implode(',', $result);
                array_push($saved_order, $result);
                $order = implode(',', $saved_order);
                $model->order = $order;
                $model->save();
            }
        }

        $model->source_type = Blog::ORDER_TYPE;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {


            return $this->redirect(['index']);

        } else {

            return $this->render('order', [
                'items' => $items,
                'model' => $model,
            ]);
        }

    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Blog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Blog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Blog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
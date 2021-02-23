<?php

namespace backend\controllers;

use Yii;
use common\models\Blocks;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Json;
use yii\web\Response;

/**
 * BlocksController implements the CRUD actions for Blocks model.
 */
class BlocksController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [

                    [
                        'actions' => ['index', 'update', 'slider', 'gallery','delete'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Blocks models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Blocks::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Blocks model.
     * @param integer $id
     * @return mixed
     */
    public function actionSlider()
    {
        $model = Blocks::find()->andWhere(['name' => Blocks::BLOCK_SLIDER])->one();

        $content = Json::decode($model->content);
        if (Yii::$app->request->isPost) {


            $data = [];
            foreach ($content as $index => $slide) {
                $file = UploadedFile::getInstance($model, "content[$index][image]");


                if ($file !== null) {

                    $prefix = Yii::getAlias('@uploads/slider/');
                    $filename = Yii::$app->security->generateRandomString(8) . '.' . $file->extension;
                    if (!file_exists(Yii::getAlias('@uploads/slider/'))) {
                        mkdir(Yii::getAlias('@uploads/slider/'), 0755, true);
                    }
                    $file->saveAs($prefix . $filename);
                    $image = $filename;
                } else {
                    $exist_image = (array_key_exists('image',$slide)? $slide['image']: '');
                    $image = $exist_image;
                }
                $data[] = ['title' => $_POST['Blocks']['content'][$index]['title'], 'description' => $_POST['Blocks']['content'][$index]['description'], 'image' => $image];
            }

            $model->content = Json::encode($data);

            if (!$model->save()) {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
            return $this->redirect(['index']);
        }
    }



    public function actionUpdate($id)
    {


        $model = $this->findModel($id);

        return $this->render('update', ['model' => $model,]);

    }

    public function actionDelete()
    {
        $model = Blocks::find()->where(['name' => Blocks::BLOCK_GALLERY])->one();
        $request = Yii::$app->request;
        $path = $request->post('path');
        $request->post('filename') ? $filename = $request->post('filename') : $filename = $request->post('filename_in_db');
        $folder = $request->post('folder');
        $filename_in_db = $request->post('filename_in_db');
        unlink($path);
        $fullpath_150x150 = \Yii::getAlias('@uploads/gallery/thumbs_150x150/' . $filename);
        if (file_exists($fullpath_150x150)) {
            unlink($fullpath_150x150);
        }
        $data =  Json::decode($model->content);
        if (null!= $data['images']) {
            $key = array_search($filename_in_db, $data['images']);
            unset($data['images'][$key]);

            $array_images ['images'] = $data ['images'];
            $array_videos ['videos'] = $data ['videos'];
            $data_to_save = array_merge($array_videos,$array_images);
        }

        $model->content = Json::encode($data_to_save ,JSON_FORCE_OBJECT);
        $model->save();
        Yii::$app->response->format = Response::FORMAT_JSON;
        return true;
    }


    protected function findModel($id)
    {
        if (($model = Blocks::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

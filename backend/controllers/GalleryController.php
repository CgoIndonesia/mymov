<?php

namespace backend\controllers;

use Yii;
use common\models\Gallery;
use common\models\GalleryImages;
use common\models\GalleryVideos;
use common\models\Order;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\web\Response;
use yii\helpers\Url;
use backend\models\Model;
use yii\helpers\Json;
use yii\filters\AccessControl;
use yii\imagine\Image;

class GalleryController extends \yii\web\Controller
{

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

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Gallery::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionUpdate($id)
    {

        $type = Yii::$app->request->get('type');
        $gallery = $this->findModel($id);

        switch ($type) {
            case 'photos':
                $modelsMedia = $gallery->photos;
                $media_instance = new GalleryImages;
                $model_name = GalleryImages::classname();
                $table = 'gallery_images';
                break;
            case 'videos':
                $modelsMedia = $gallery->videos;
                $media_instance = new GalleryVideos;
                $model_name = GalleryVideos::classname();
                $table = 'gallery_videos';
                break;
        }

        if ($gallery->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($modelsMedia, 'id', 'id');
            $modelsMedia = Model::createMultiple($model_name, $modelsMedia);
            Model::loadMultiple($modelsMedia, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsMedia, 'id', 'id')));
            foreach ($modelsMedia as $index => $modelMedia) {
                $modelMedia->sort_order = $index;
            }

            if ($type == 'photos') {

                foreach ($modelsMedia as $index => $modelMedia) {
                    $upload = \yii\web\UploadedFile::getInstance($modelMedia, "[{$index}]file");
                    if ($upload != null) {
                        if (!file_exists(\Yii::getAlias('@uploads/gallery'))) {
                            mkdir(\Yii::getAlias('@uploads/gallery'), 0755, true);
                        }
                        if (!file_exists(\Yii::getAlias('@uploads/gallery/thumbs_370x280'))) {
                            mkdir(\Yii::getAlias('@uploads/gallery/thumbs_370x280'), 0755, true);
                        }
                        $uploadPath = Yii::getAlias('@uploads/gallery');
                        $filename = md5(time()) . $upload->name;
                        $path = $uploadPath . '/' . $filename;
                        $upload->saveAs($path);
                        Image::thumbnail(Yii::getAlias('@uploads/gallery/' . $filename), 370, 280)
                            ->save(Yii::getAlias('@uploads/gallery/thumbs_370x280/' . $filename), ['quality' => 100]);
                        $modelMedia->image = $filename;
                    }

                }
            }
            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsMedia),
                    ActiveForm::validate($gallery)
                );
            }

            // validate all models
            $valid = $gallery->validate();
            $valid = Model::validateMultiple($modelsMedia) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $gallery->save(false)) {
                        if ($type == 'photos') {
                            foreach ($deletedIDs as $image_id) {

                                $images = GalleryImages::findOne($image_id);
                                if (file_exists(Yii::getAlias('@uploads/gallery/' . $images->image))) {
                                    $path = Yii::getAlias('@uploads/gallery/' . $images->image);
                                    unlink($path);
                                }
                                if (file_exists(Yii::getAlias('@uploads/gallery/thumbs_370x280/' . $images->image))) {
                                    $path_thumbs_370x280 = Yii::getAlias('@uploads/gallery/thumbs_370x280/' . $images->image);
                                    unlink($path_thumbs_370x280);
                                }
                            }
                        }


                        if (!empty($deletedIDs)) {
                            \Yii::$app
                                ->db
                                ->createCommand()
                                ->delete($table, ['id' => $deletedIDs])
                                ->execute();


                        }

                        if ($flag) {
                            foreach ($modelsMedia as $modelMedia) {
                                $modelMedia->gallery_id = $gallery->id;
                                if (($flag = $modelMedia->save(false)) === false) {
                                    $transaction->rollBack();
                                    break;
                                }
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['index?type=' . $type]);
                    }

                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'gallery' => $gallery,
            'modelsMedia' => (empty($modelsMedia)) ? [$media_instance] : $modelsMedia,
            'type' => $type,

        ]);
    }

    protected function findModel($id)
    {
        if (($model = Gallery::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

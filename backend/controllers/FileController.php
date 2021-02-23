<?php
/**
 * Created by PhpStorm.
 * User: ANDREW
 * Date: 8/6/2016
 * Time: 8:14 PM
 */

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\helpers\Url;
use common\models\Images;
use yii\imagine\Image;

class FileController extends Controller
{

    public function behaviors()
    {
        return [
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


    public function actionUploadContent()
    {

        $upload = UploadedFile::getInstanceByName('file');
        $folder = 'content';
        if ($upload != null) {
            if (!file_exists(\Yii::getAlias('@uploads/' . $folder))) {
                mkdir(\Yii::getAlias('@uploads/' . $folder), 0755, true);
            }
            $uploadPath = Yii::getAlias('@uploads/' . $folder);
            $filename = md5(time()) . $upload->name;
            $upload->saveAs($uploadPath . '/' . $filename);
            $result = ['filelink' => '/uploads/' . $folder . '/' . $filename];
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $result;

        }
    }

    public function actionUpload()
    {
        $response = [];
        $upload = UploadedFile::getInstancesByName('files');
        $request = Yii::$app->request;
        $folder = $request->post('folder');
        if ($upload != null) {
            if (!file_exists(\Yii::getAlias('@uploads/' . $folder))) {
                mkdir(\Yii::getAlias('@uploads/' . $folder), 0755, true);
            }
            $uploadPath = Yii::getAlias('@uploads/' . $folder);
            foreach ($upload as $key => $file) {

                $filename = md5(time()) . $file->name;
                $path = $uploadPath . '/' . $filename;
                $file->saveAs($path);
                $this->saveThumbnail($path, $filename, $folder);
                $upload = \Yii::$app->session['upload'];
                $upload[] = $filename;
                \Yii::$app->session['upload'] = $upload;
                $initialPreview ['initialPreview'] [] = '/uploads/' . $folder . '/' . $filename;
                $initialPreviewConfig ['initialPreviewConfig'] [] = [
                    'caption' => $file->name, 'size' => $file->size, 'width' => '120px', 'url' => Url::to(['/file/delete']), 'key' => $key, 'extra' => ['path' => $path, 'filename' => $filename, 'folder' => $folder],
                ];
            }
            $response = array_merge($initialPreview, $initialPreviewConfig);
            array_push($response, 'append => true');
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $response;
        }
    }

    public function actionDelete()
    {
        $request = Yii::$app->request;
        $path = $request->post('path');
        $request->post('filename') ? $filename = $request->post('filename') : $filename = $request->post('filename_in_db');
        $folder = $request->post('folder');
        $filename_in_db = $request->post('filename_in_db');
        if (file_exists($path)) {
            if ($filename_in_db) {
                $model = Images::find()->where(['name' => $filename_in_db])->one();
                $model->delete();
            }
            $this->deleteThumbnail($filename, $folder);
            unlink($path);
        }
        Yii::$app->response->format = Response::FORMAT_JSON;
        return true;
    }

    public function actionDeleteContent()
    {
        $request = Yii::$app->request;
        $path = $request->post('image');
        $folder = 'content';
        $path_parts = pathinfo($path);
        $filename = $path_parts['filename'] . '.' . $path_parts['extension'];
        $fullpath = Yii::getAlias('@uploads/' . $folder . '/' . $filename);
        if (file_exists($fullpath)) {
            $model = Images::find()->where(['name' => $filename])->one();
            if ($model) {
                $model->delete();
            }
            unlink($fullpath);
        }

        Yii::$app->response->format = Response::FORMAT_JSON;
        return true;
    }


    public function saveThumbnail($path, $filename, $folder)
    {


        switch ($folder) {
            case 'tours':
                if (!file_exists(\Yii::getAlias('@uploads/' . $folder . '/thumbs_350x220'))) {
                    mkdir(\Yii::getAlias('@uploads/' . $folder . '/thumbs_350x220'), 0755, true);
                }
                if (!file_exists(\Yii::getAlias('@uploads/' . $folder . '/thumbs_350x270'))) {
                    mkdir(\Yii::getAlias('@uploads/' . $folder . '/thumbs_350x270'), 0755, true);
                }
                Image::thumbnail($path, 350, 220)
                    ->save(Yii::getAlias('@uploads/' . $folder . '/thumbs_350x220/' . $filename), ['quality' => 100]);
                Image::thumbnail($path, 350, 270)
                    ->save(Yii::getAlias('@uploads/' . $folder . '/thumbs_350x270/' . $filename), ['quality' => 100]);
                break;
            case 'accommodations':
                if (!file_exists(\Yii::getAlias('@uploads/' . $folder . '/thumbs_370x270'))) {
                    mkdir(\Yii::getAlias('@uploads/' . $folder . '/thumbs_370x270'), 0755, true);
                }
                Image::thumbnail($path, 370, 270)
                    ->save(Yii::getAlias('@uploads/' . $folder . '/thumbs_370x270/' . $filename), ['quality' => 100]);
                break;
            case 'content':
                if (!file_exists(\Yii::getAlias('@uploads/' . $folder . '/thumbs_570x370'))) {
                    mkdir(\Yii::getAlias('@uploads/' . $folder . '/thumbs_570x370'), 0755, true);
                }
                if (!file_exists(\Yii::getAlias('@uploads/' . $folder . '/thumbs_870x420'))) {
                    mkdir(\Yii::getAlias('@uploads/' . $folder . '/thumbs_870x420'), 0755, true);
                }
                Image::thumbnail($path, 570, 370)
                    ->save(Yii::getAlias('@uploads/' . $folder . '/thumbs_570x370/' . $filename), ['quality' => 100]);
                Image::thumbnail($path, 870, 420)
                    ->save(Yii::getAlias('@uploads/' . $folder . '/thumbs_870x420/' . $filename), ['quality' => 100]);
                break;
            case 'guides':
                if (!file_exists(\Yii::getAlias('@uploads/' . $folder . '/thumbs_350x273'))) {
                    mkdir(\Yii::getAlias('@uploads/' . $folder . '/thumbs_350x273'), 0755, true);
                }
                Image::thumbnail($path, 350, 273)
                    ->save(Yii::getAlias('@uploads/' . $folder . '/thumbs_350x273/' . $filename), ['quality' => 100]);
                break;
                 case 'feedbacks':
                if (!file_exists(\Yii::getAlias('@uploads/' . $folder . '/thumbs_150x150'))) {
                    mkdir(\Yii::getAlias('@uploads/' . $folder . '/thumbs_150x150'), 0755, true);
                }
                Image::thumbnail($path, 150, 150)
                    ->save(Yii::getAlias('@uploads/' . $folder . '/thumbs_150x150/' . $filename), ['quality' => 100]);
                break;
                 case 'team':
                if (!file_exists(\Yii::getAlias('@uploads/' . $folder . '/thumbs_640x500'))) {
                    mkdir(\Yii::getAlias('@uploads/' . $folder . '/thumbs_640x500'), 0755, true);
                }
                Image::thumbnail($path, 640, 500)
                    ->save(Yii::getAlias('@uploads/' . $folder . '/thumbs_640x500/' . $filename), ['quality' => 100]);
                break;
            default:
                return false;
        }
    }

    public function deleteThumbnail($filename, $folder)
    {

        switch ($folder) {
            case 'tours':
                $fullpath_350x220 = \Yii::getAlias('@uploads/' . $folder . '/thumbs_350x220/' . $filename);

                if (file_exists($fullpath_350x220)) {
                    unlink($fullpath_350x220);
                }
                break;
            case 'accommodations':
                $fullpath_370x270 = \Yii::getAlias('@uploads/' . $folder . '/thumbs_370x270/' . $filename);
                if (file_exists($fullpath_370x270)) {
                    unlink($fullpath_370x270);
                }
                break;
            case 'content':
                $fullpath_570x370 = \Yii::getAlias('@uploads/' . $folder . '/thumbs_570x370/' . $filename);
                $fullpath_870x420 = \Yii::getAlias('@uploads/' . $folder . '/thumbs_870x420/' . $filename);
                if (file_exists($fullpath_570x370)) {
                    unlink($fullpath_570x370);
                }
                if (file_exists($fullpath_870x420)) {
                    unlink($fullpath_870x420);
                }
                break;
            case 'guides':
                $fullpath_350x273 = \Yii::getAlias('@uploads/' . $folder . '/thumbs_350x273/' . $filename);
                if (file_exists($fullpath_350x273)) {
                    unlink($fullpath_350x273);
                }
                break;
                case 'feedbacks':
                $fullpath_150x150 = \Yii::getAlias('@uploads/' . $folder . '/thumbs_150x15/' . $filename);
                if (file_exists($fullpath_150x150)) {
                    unlink($fullpath_150x150);
                }
                break;
                 case 'team':
                $fullpath_640x500 = \Yii::getAlias('@uploads/' . $folder . '/thumbs_640x500/' . $filename);
                if (file_exists($fullpath_640x500)) {
                    unlink($fullpath_640x500);
                }
                break;
            default:
                return false;


        }
    }
}
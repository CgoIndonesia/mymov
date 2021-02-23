<?php

namespace backend\controllers;

use Yii;
use common\models\Feedbacks;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\filters\AccessControl;

/**
 * FeedbacksController implements the CRUD actions for Feedbacks model.
 */
class FeedbacksController extends Controller
{
    /**
     * @inheritdoc
     */
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
     * Lists all Feedbacks models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Feedbacks::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

 
    /**
     * Creates a new Feedbacks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Feedbacks();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
              return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Feedbacks model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
            foreach ($model->images as $key => $image) {
            if (file_exists(Yii::getAlias('@uploads/feedbacks/' . $image->name))) {
                $initialPreview [] = '/uploads/feedbacks/' . $image->name;
                $initialPreviewConfig [] = [
                    'caption' => $image->name, 'width' => '120px', 'url' => Url::to(['/file/delete']), 'key' => $key, 'extra' => ['path' => Yii::getAlias('@uploads/feedbacks/' . $image->name), 'filename_in_db' => $image->name, 'folder' => 'feedbacks'],
                ];
            }
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
              return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'initialPreview' => !empty($initialPreview) ? $initialPreview : [],
                'initialPreviewConfig' => !empty($initialPreviewConfig) ? $initialPreviewConfig : [],
            ]);
        }
    }

    /**
     * Deletes an existing Feedbacks model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Feedbacks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Feedbacks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Feedbacks::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

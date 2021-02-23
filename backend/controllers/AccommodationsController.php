<?php

namespace backend\controllers;

use Yii;
use common\models\Accommodations;
use common\models\Order;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\filters\AccessControl;

/**
 * Accommodations Controller implements the CRUD actions for Accommodations  model.
 */
class AccommodationsController extends Controller
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

    public function actions()
    {
        return [

        'files-get' => [
        'class' => 'vova07\imperavi\actions\GetAction',
                'url' => '/uploads/accommodations/', // Directory URL address, where files are stored.
                'path' => \Yii::getAlias('@uploads/accommodations/'), // Or absolute path to directory where files are stored.
                ]
                ];
            }


    /**
     * Lists all Accommodations  models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Accommodations::find(),
            ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            ]);
    }


    public function actionCreate()
    {
        $model = new Accommodations();
        $model->status = 1;
        if (Yii::$app->request->isPost) {
            $features = Yii::$app->request->post('features');
            $features = array_filter($features);
            foreach ($features as $key => $feature) {
                $features_list[$key] = $model::GetAccommodationsFeatures($key);
            }
            $model->features = !empty($features_list) ? Json::encode($features_list, JSON_FORCE_OBJECT) : Json::encode([], JSON_FORCE_OBJECT);
        }
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
     * Updates an existing Accommodations  model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        foreach ($model->images as $key => $image) {
            if (file_exists(Yii::getAlias('@uploads/accommodations/' . $image->name))) {
                $initialPreview [] = '/uploads/accommodations/' . $image->name;
                $initialPreviewConfig [] = [
                'caption' => $image->name, 'width' => '120px', 'url' => Url::to(['/file/delete']), 'key' => $key, 'extra' => ['path' => Yii::getAlias('@uploads/accommodations/' . $image->name), 'filename_in_db' => $image->name, 'folder' => 'accommodations'],
                ];
            }
        }

        $features = Json::decode($model->features);


        if (Yii::$app->request->isPost) {
            $features = Yii::$app->request->post('features');
            $features = array_filter($features);
            foreach ($features as $key => $feature) {
                $features_list[$key] = $model::GetAccommodationsFeatures($key);
            }

            $model->features = !empty($features_list) ? Json::encode($features_list, JSON_FORCE_OBJECT) : Json::encode([], JSON_FORCE_OBJECT);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            unset(\Yii::$app->session['upload']);
            return $this->render('update', [
                'model' => $model,
                'initialPreview' => !empty($initialPreview) ? $initialPreview : [],
                'initialPreviewConfig' => !empty($initialPreviewConfig) ? $initialPreviewConfig : [],
                'features' => $features,

                ]);
        }
    }


    public function actionOrder()
    {
        $model = Order::find()->where(['source_type'=> Accommodations::ORDER_TYPE])->one();
        $accommodations = Accommodations::find()->all(); 

        foreach ($accommodations as $accommodation) {

            $accommmodations_id [] = $accommodation->id;
            $items [$accommodation->id] = ['content' => $accommodation->name];
        }

        $saved_order = explode(',', $model->order);
        if ($model->order) {

            $result = array_diff($accommmodations_id, $saved_order);
              if ($result)  {    
           $result  = implode(',' , $result);
           array_push($saved_order, $result);
           $order = implode(',' ,$saved_order);
           $model->order =$order;
           $model->save();
       }
   }

       $model->source_type = Accommodations::ORDER_TYPE;

       if ($model->load(Yii::$app->request->post()) && $model->save()) {


          return $this->redirect(['index']);

      } else {

        return $this->render('order', [
            'items' => $items,
            'model' => $model,
            ]);
    }

}

    /**
     * Deletes an existing Accommodations  model.
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
     * Finds the Accommodations  model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Accommodations  the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Accommodations::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

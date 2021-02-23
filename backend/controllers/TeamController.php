<?php

namespace backend\controllers;
use Yii;
use common\models\Team;
use common\models\Order;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\filters\AccessControl;

class TeamController extends \yii\web\Controller
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
            'query' => Team::find(),
            ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            ]);
    }


    public function actionCreate()
    {
        $model = new Team();
   
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
     * Updates an existing Tours model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        foreach ($model->images as $key => $image) {
            if (file_exists(Yii::getAlias('@uploads/team/'.$image->name))) {
                $initialPreview [] = '/uploads/team/' . $image->name;
                $initialPreviewConfig [] = [
                'caption' => $image->name, 'width' => '120px', 'url' => Url::to(['/file/delete']), 'key' => $key, 'extra' => ['path' => Yii::getAlias('@uploads/team/' . $image->name), 'filename_in_db' => $image->name,'folder' => 'team'],
                ];
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            unset(\Yii::$app->session['upload']);
            return $this->render('update', [
                'model' => $model,
                'initialPreview' => !empty($initialPreview)? $initialPreview :[],
                'initialPreviewConfig' => !empty($initialPreviewConfig) ? $initialPreviewConfig : [],

                ]);
        }
    }
    public function actionOrder()
    {
        $model = Order::find()->where(['source_type'=> Team::ORDER_TYPE])->one();
        $team = Team::find()->all(); 

        foreach ($team as $member) {

            $team_id [] = $member->id;
            $items [$member->id] = ['content' => $member->name];
        }

        $saved_order = explode(',', $model->order);
        if ($model->order) {

            $result = array_diff($team_id, $saved_order);
              if ($result)  {    
           $result  = implode(',' , $result);
           array_push($saved_order, $result);
           $order = implode(',' ,$saved_order);
           $model->order =$order;
           $model->save();
       }
   }

       $model->source_type = Team::ORDER_TYPE;

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
     * Deletes an existing Tours model.
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
     * Finds the Tours model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tours the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Team::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }



}
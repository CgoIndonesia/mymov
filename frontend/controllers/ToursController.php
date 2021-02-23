<?php

namespace frontend\controllers;

use Yii;
use common\models\Tours;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use common\models\Order;

/**
 * ToursController implements the CRUD actions for Tours model.
 */
class ToursController extends Controller
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
        ];
    }

    /**
     * Lists all Tours models.
     * @return mixed
     */
    public function actionIndex()

    {
         $order = Order::find()->where(['source_type'=>2])->one();
        $ids = $order->order;
        $dataProvider = new ActiveDataProvider([
            'query' => Tours::find()->where(['status'=>1])->orderBy([new \yii\db\Expression(sprintf("FIELD(id, %s)", implode(",", [$ids])))]),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tours model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'features' => !empty($this->findModel($id)->features)? Json::decode($this->findModel($id)->features): [],
        ]);
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
        if (($model = Tours::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

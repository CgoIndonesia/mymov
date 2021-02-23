<?php

namespace backend\controllers;

use Yii;
use common\models\Categories;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * CategoriesController implements the CRUD actions for Categories model.
 */
class CategoriesController extends Controller
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
     * Lists all Categories models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Categories::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Categories model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Categories model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Categories();
        $model->cache = 1;
        $model->status = 1;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if (empty($model->parent)) {
                $data = $model->saveNode();
            } else {
                $parent = Categories::findOne($model->parent);
                $data = $model->appendTo($parent);
            }
            if ($data) {
                return $this->redirect('index');
            }
        }
        return $this->render('create', [
            'model' => $model,

        ]);
    }

    /**
     * Updates an existing Categories model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->parent()->one() ? $parent = $model->parent()->one()->id : $parent = null;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->id == $model->parent) {
                \Yii::$app->getSession()->setFlash('error', 'Category cannot be parent itself');
            } else {
                if ($model->parent !== null && $model->parent !== $parent) {
                    $parent_id = Categories::findOne($model->parent);
                    $data = $model->moveAsLast($parent_id);
                } elseif ($parent && !$model->parent) {
                    $data = $model->moveAsRoot();
                } else {
                    $data = $model->saveNode();
                }
                if ($data) {
                    return $this->redirect('index');
                }
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }


    /**
     * Deletes an existing Categories model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */

    public function actionDelete($id)
    {
        $this->findModel($id)->deleteNode();

        return $this->redirect('index');
    }

    /**
     * Finds the Categories model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Categories the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected
    function findModel($id)
    {
        if (($model = Categories::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

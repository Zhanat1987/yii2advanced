<?php

namespace backend\controllers;

use common\myhelpers\Debugger;
use Yii;
use backend\models\Article;
use backend\models\search\ArticleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\VerbFilter;
use yii\web\UploadedFile;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Article model.
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
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Article;
        $model->scenario = 'create';
        if ($model->load(Yii::$app->request->post())) {
//            $validator = new \yii\validators\FileValidator();
//            if ($validator->validate($model->img, $error)) {
//                echo 'File is valid.';
//            } else {
//                echo $error;
//            }
//            exit;
            \common\myhelpers\Debugger::margin();
//            \common\myhelpers\Debugger::debug($_POST);
//            \common\myhelpers\Debugger::debug($_FILES);
//            \common\myhelpers\Debugger::stop($model->img);
            $model->img = $_FILES['Article']['name']['img'];
            if ($model->validate()) {
                $img = UploadedFile::getInstance($model, 'img');
                $model->save(false);
                if ($img) {
                    $img->saveAs(Yii::getAlias('@common/uploads/img/article/' .
                        $model->id . '.' . $img->extension));
                }
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                $errors = $model->getErrors();
            }
            \common\myhelpers\Debugger::debug($model->getErrors('img'));
        }
        return $this->render('create', [
            'model' => $model,
            'errors' => isset($errors) ? $errors : '',
        ]);
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'errors' => isset($errors) ? $errors : '',
            ]);
        }
    }

    /**
     * Deletes an existing Article model.
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
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if ($id !== null && ($model = Article::find($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

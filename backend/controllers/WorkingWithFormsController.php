<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\FM;

/**
 * WorkingWithForms controller
 */
class WorkingWithFormsController extends Controller
{

	public function actionIndex()
	{
        $model = new FM;
        if ($model->load(Yii::$app->request->post())) {
            $model->validate();
        }
		return $this->render('index', [
            'model' => $model,
        ]);
	}

}

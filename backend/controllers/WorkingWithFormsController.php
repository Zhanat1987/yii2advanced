<?php
namespace backend\controllers;

use Yii;
use common\components\MyController;
use backend\models\FM;

/**
 * WorkingWithForms controller
 */
class WorkingWithFormsController extends MyController
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

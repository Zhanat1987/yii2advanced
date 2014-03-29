<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Caching;

/**
 * WorkingWithForms controller
 */
class CachingController extends Controller
{

	public function actionIndex()
	{
        $model = new Caching;
		return $this->render('index', [
            'model' => $model,
        ]);
	}

}

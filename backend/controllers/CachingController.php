<?php
namespace backend\controllers;

use Yii;
use common\components\MyController;
use backend\models\Caching;

/**
 * WorkingWithForms controller
 */
class CachingController extends MyController
{

	public function actionIndex()
	{
//        Yii::$app->cache->delete('allCaching');
        $model = new Caching;
        $models = $model->getAll();
		return $this->render('index', [
            'models' => $models,
        ]);
	}

}

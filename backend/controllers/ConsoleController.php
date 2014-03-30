<?php
namespace backend\controllers;

use Yii;
use common\components\MyController;

/**
 * Console controller
 */
class ConsoleController extends MyController
{

	public function actionIndex()
	{
		return $this->render('index');
	}

}

<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;

/**
 * Console controller
 */
class ConsoleController extends Controller
{

	public function actionIndex()
	{
		return $this->render('index');
	}

}

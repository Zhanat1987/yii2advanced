<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;

/**
 * BootstrapWidgets controller
 */
class BootstrapWidgetsController extends Controller
{

	public function actionIndex()
	{
		return $this->render('index');
	}

    public function actionWidgets()
    {
        return $this->render('widgets');
    }

    public function actionLess()
    {
        return $this->render('less');
    }

}

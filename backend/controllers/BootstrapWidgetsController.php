<?php
namespace backend\controllers;

use Yii;
use common\components\MyController;

/**
 * BootstrapWidgets controller
 */
class BootstrapWidgetsController extends MyController
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

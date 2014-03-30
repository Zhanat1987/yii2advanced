<?php
namespace backend\controllers;

use Yii;
use common\components\MyController;

/**
 * Theming controller
 */
class ThemingController extends MyController
{

	public function actionIndex()
	{
		return $this->render('index');
	}

    public function actionIndex2()
    {
        return $this->render('index2');
    }

    public function actionIndex3()
    {
        return $this->render('index3');
    }

    public function actionIndex4()
    {
        return $this->render('index4');
    }

}

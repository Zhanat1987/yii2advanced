<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;

/**
 * Theming controller
 */
class ThemingController extends Controller
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

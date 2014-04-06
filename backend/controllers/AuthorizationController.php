<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use common\components\MyController;
use common\myhelpers\Debugger;

/**
 * Authorization controller
 */
class AuthorizationController extends MyController
{
	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
//                'only' => ['index', 'index3', 'index5'],
                'rules' => [
					[
						'actions' => ['index', 'index2'],
						'allow' => true,
					],
					[
						'actions' => ['index3', 'index4'],
						'allow' => true,
						'roles' => ['@'],
					],
                    [
                        'actions' => ['index5'],
                        'allow' => false,
                    ],
                    [
                        'actions' => ['index6'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['special-callback'],
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                                return date('Y-m-d H:i') === '2014-04-06 07:23';
                            }
                    ],
                ],
			],
		];
	}

	public function actionIndex()
	{
        Debugger::margin();
        Debugger::debug(date('Y-m-d H:i'));
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

    public function actionIndex5()
    {
        return $this->render('index5');
    }

    public function actionIndex6()
    {
        return $this->render('index6');
    }

    public function actionSpecialCallback()
    {
        return $this->render('special-callback');
    }

}

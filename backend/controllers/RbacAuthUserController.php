<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use common\components\MyController;

/**
 * RbacAuthUser controller
 */
class RbacAuthUserController extends MyController
{
	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
            'access' => [
				'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['user'],
                    ],
                ],
            ],
		];
	}

	public function actionIndex()
	{
		return $this->render('index');
	}

}

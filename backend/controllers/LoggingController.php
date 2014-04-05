<?php
namespace backend\controllers;

use Yii;
use common\components\MyController;
use common\myhelpers\Debugger;

/**
 * Logging controller
 */
class LoggingController extends MyController
{

	public function actionIndex()
	{
//        $test = Yii::$app->mail->compose('/logging/email', ['test' => 'test'])
//            ->setFrom('logging@email.com')
//            ->setTo(Yii::$app->params['adminEmail'])
//            ->setSubject('Логирование')
//            ->send();
//        Debugger::margin();
//        Debugger::debug($test);
//        Yii::info('Hello, I am a test log message', 'test');
        \Yii::beginProfile('block1');
        // some code to be profiled
        for ($i = 0; $i < 10; ++$i) {
            \yii\helpers\Security::generateRandomKey(10);
        }
        \Yii::beginProfile('block2');
        // some other code to be profiled
        for ($i = 0; $i < 10; ++$i) {
            \yii\helpers\Security::generatePasswordHash(\yii\helpers\Security::generateRandomKey(10));
        }
        \Yii::endProfile('block2');
        \Yii::endProfile('block1');
        return $this->render('index', [

        ]);
	}

}

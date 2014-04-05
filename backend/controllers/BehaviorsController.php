<?php
namespace backend\controllers;

use Yii;
use common\components\MyController;
use common\myhelpers\Debugger;
use backend\models\Behaviors;
use yii\helpers\Security;

/**
 * Behaviors controller
 */
class BehaviorsController extends MyController
{

	public function actionIndex()
	{
//        $float = 10.0;
//        $float2 = 10.1;
//        $int = 10;
//        Debugger::debug($float2 % 1);
//        Debugger::debug($float % 1);
//        Debugger::debug($int === (int) $float2);
//        Debugger::stop($int === (int) $float);
        $behaviors = new Behaviors;
        $behaviors->title = Security::generateRandomKey();
        $behaviors->insert = '3t';
//        $behaviors->update = '25';
        $behaviors->update = '10';
        $behaviors->validate();
        $behaviors->save();
        Debugger::debug($behaviors->getErrors());
        $behavior = Behaviors::find(7);
        $behavior->title = Security::generateRandomKey();
//        $behavior->update = '256';
        $behavior->save();
		return $this->render('index');
	}

}

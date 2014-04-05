<?php
namespace backend\controllers;

use Yii;
use common\components\MyController;
use common\myhelpers\Debugger;
use yii\helpers\Security;

/**
 * Security controller
 */
class SecurityController extends MyController
{

	public function actionIndex()
	{
        $password = Security::generateRandomKey(10);
        $hash = Security::generatePasswordHash($password);
        Debugger::margin();
        Debugger::debug($hash);
        Debugger::debug(Security::validatePassword($password, $hash));
        $data = 'данные';
        $secretKey = 'секретный ключ';
        $encryptedData = Security::encrypt($data, $secretKey);
        Debugger::debug($encryptedData);
        $data = Security::decrypt($encryptedData, $secretKey);
        Debugger::debug($data);
        $data = Security::hashData($data, $secretKey);
        Debugger::debug(Security::validateData($data, $secretKey));
		return $this->render('index');
	}

}

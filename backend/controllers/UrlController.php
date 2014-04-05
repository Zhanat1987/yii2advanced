<?php
namespace backend\controllers;

use Yii;
use common\components\MyController;
use common\myhelpers\Debugger;

/**
 * Url controller
 */
class UrlController extends MyController
{

    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            if ($action->id == 'before') {
                Debugger::margin();
                echo '<h3>ID контроллера</h3>';
                Debugger::debug($this->id);
                echo '<h3>ID действия</h3>';
                Debugger::debug($action->id);
                echo '<h3>ID модуля</h3>';
                Debugger::debug($this->module->id);
            }
            return true;
        } else {
            return false;
        }
    }

    public function afterAction($action, $result)
    {
        if ($action->id == 'after') {
            Debugger::margin();
            echo '<h3>$action</h3>';
            Debugger::debug($action);
            echo '<h3>$result</h3>';
            Debugger::debug($result);
        }
        return parent::afterAction($action, $result);
    }

	public function actionIndex()
	{
		return $this->render('index');
	}

    public function actionIndex2()
    {
        return $this->render('index2');
    }

    public function actionIndex3($param1, $param2)
    {
        return $this->render('index3', [
            'param1' => $param1,
            'param2' => $param2,
        ]);
    }

    public function actionBefore()
    {
        return $this->render('before');
    }

    public function actionAfter()
    {
        return $this->render('after');
    }

    public function actionUrlHelper()
    {
        return $this->render('url-helper');
    }

}

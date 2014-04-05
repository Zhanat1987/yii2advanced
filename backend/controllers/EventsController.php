<?php
namespace backend\controllers;

use Yii;
use common\components\MyController;
use common\myhelpers\Debugger;
use yii\base\ViewEvent;
use yii\base\View;
use backend\events\MyHandler;

/**
 * Events controller
 * yii\base\Event
 * yii\base\ViewEvent
 * yii\base\ModelEvent
 * yii\base\ActionEvent
 * find in path в 'vendor/yiisoft': 'EVENT_'
 */
class EventsController extends MyController
{

    public function afterAction($action, $result)
    {
        Yii::$app->on(View::EVENT_AFTER_RENDER, function($event) {
            Debugger::margin();
//            Debugger::debug($event->data['param1Key']);
//            Debugger::debug($event->data);
            Debugger::debug($event->output);
            Debugger::debug($event->isValid);
//            Debugger::debug($event);
//            Debugger::stop($event);
//            $event->output = 'test2';
        }, [
            'param1Key' => 'param1Value',
            'param2Key' => 'param2Value',
        ]);
//        Yii::$app->trigger(View::EVENT_AFTER_RENDER);
        /**
         * инициировать событие класса ViewEvent
         */
        $viewEvent = new ViewEvent;
        Yii::$app->trigger(View::EVENT_AFTER_RENDER, $viewEvent);
        return parent::afterAction($action, $result);
    }

    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            /**
             * подключить обработчик события
             */
            Yii::$app->on(View::EVENT_BEFORE_RENDER,
                ['backend\events\MyHandler', 'viewBeforeRenderStatic']);
            Yii::$app->on(View::EVENT_BEFORE_RENDER,
                'backend\controllers\viewBeforeRenderGlobal');
            Yii::$app->on(View::EVENT_BEFORE_RENDER,
                function ($event) {
                    Debugger::margin();
                    echo '<h3>Hello from callback!!!</h3>';
                });
            $myHandler = new MyHandler;
            Yii::$app->on(View::EVENT_BEFORE_RENDER,
                [$myHandler, 'viewBeforeRender']);
            Yii::$app->on(View::EVENT_BEFORE_RENDER,
                [$myHandler, 'viewBeforeRender2']);
            /**
             * отключить обработчик события
             */
//            Yii::$app->off(View::EVENT_BEFORE_RENDER);
            Yii::$app->off(View::EVENT_BEFORE_RENDER,
                ['backend\events\MyHandler', 'viewBeforeRenderStatic']);
            Yii::$app->off(View::EVENT_BEFORE_RENDER,
                'backend\controllers\viewBeforeRenderGlobal');
            /**
             * callback и обработчик экземпляра класса
             * отключаются только с помощью
             * Yii::$app->off(View::EVENT_BEFORE_RENDER);
             */
//            Yii::$app->off(View::EVENT_BEFORE_RENDER,
//                function ($event) {
//                    Debugger::margin();
//                    echo '<h3>Hello from callback!!!</h3>';
//                });
//            $myHandler = new MyHandler;
//            Yii::$app->off(View::EVENT_BEFORE_RENDER,
//                [$myHandler, 'viewBeforeRender']);
//            Yii::$app->off(View::EVENT_BEFORE_RENDER,
//                [$myHandler, 'viewBeforeRender2']);
            /**
             * инициировать событие класса EVENT
             */
//            Yii::$app->trigger(View::EVENT_BEFORE_RENDER);
            /**
             * инициировать событие класса ViewEvent
             */
            $viewEvent = new ViewEvent;
            Yii::$app->trigger(View::EVENT_BEFORE_RENDER, $viewEvent);
            return true;
        } else {
            return false;
        }
    }

	public function actionIndex()
	{
		return $this->render('index');
	}

}

function viewBeforeRenderGlobal($event)
{
    Debugger::margin();
    echo '<h3>Hello from global function ' . __METHOD__ . '!!!</h3>';
}
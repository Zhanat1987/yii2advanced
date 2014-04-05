<?php
/**
 * Created by PhpStorm.
 * User: zhanat
 * Date: 05.04.14
 * Time: 13:50
 */

namespace backend\events;

use common\myhelpers\Debugger;
use yii\base\Component;

class MyHandler extends Component
{

    public function viewBeforeRender($event)
    {
        Debugger::margin();
        echo '<h3>' . __METHOD__ . '</h3>';
        /**
         * остановить выполнение еще не сработавших
         * обработчиков текущего события
         */
        $event->handled = true;
//        Debugger::debug($event);
    }

    public function viewBeforeRender2($event)
    {
        Debugger::margin();
        echo '<h3>' . __METHOD__ . '</h3>';
    }

    public static function viewBeforeRenderStatic($event)
    {
        Debugger::margin();
        echo '<h3>' . __METHOD__ . '</h3>';
    }

} 
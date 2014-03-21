<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 17.03.14
 * Time: 21:07
 */

namespace common\myhelpers;


class Debugger
{

    public static function debug($v)
    {
        echo '<pre style="background-color: #000; color: #fff; font-size: 14px; font-weight: 600;
                            line-height: 18px;">';
        var_dump($v);
        echo '</pre>';
    }

    public static function stop($v)
    {
        exit(self::debug($v));
    }

} 
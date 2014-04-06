<?php
/**OnlySecondUser
 * Created by PhpStorm.
 * User: admin
 * Date: 06.04.14
 * Time: 10:52
 */

namespace backend\rbac;

use yii\rbac\Rule;
use common\myhelpers\Debugger;

class OnlySecondUser extends Rule
{

    public function execute($params, $data)
    {
//        Debugger::stop(\Yii::$app->user->identity->id == 2);
//        Debugger::debug($params);
//        Debugger::stop($data);
        /**
         * все 4 условия правильны
         */
//        return \Yii::$app->user->identity->id == 2 ? true : false;
//        return $params['userId'] == 2 ? true : false;
//        return \Yii::$app->user->identity->id == 2;
        return $params['userId'] == 2;
    }

}
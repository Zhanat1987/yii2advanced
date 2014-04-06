<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 06.04.14
 * Time: 8:36
 */

namespace backend\components;

use Yii;
use common\myhelpers\Debugger;

class PhpManager extends \yii\rbac\PhpManager
{

    public function init()
    {
        parent::init();
        if (!Yii::$app->user->isGuest) {
//            Debugger::stop(Yii::$app->user->identity);
            // we suppose that user's role is stored in identity
//            $this->assign(Yii::$app->user->identity->id,
//                Yii::$app->user->identity->role);
            $this->assign(Yii::$app->user->identity->id,
                Yii::$app->user->identity->rbac);
        }
    }

}
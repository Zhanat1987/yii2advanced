<?php
/**
 * Created by PhpStorm.
 * User: zhanat
 * Date: 30.03.14
 * Time: 15:44
 */

namespace common\components;

use yii\web\Controller;

class MyController extends Controller
{

    public function init()
    {
        if (!empty($_GET['language']))
            \Yii::$app->language = $_GET['language'];
        parent::init();
    }

    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            return true;
        } else {
            return false;
        }
    }

    public function afterAction($action, $result)
    {
        return parent::afterAction($action, $result);
    }

}
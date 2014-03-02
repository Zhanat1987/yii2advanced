<?php
namespace frontend\controllers;

use yii\web\Controller;
use Yii;

/**
 * Guide controller
 */
class GuideController extends Controller
{

    public function actionAdvancedTemplate()
    {
        return $this->render('advanced-template');
    }

    public function actionConfiguration()
    {
        return $this->render('configuration');
    }

    public function actionBasicConcepts()
    {
        return $this->render('basic-concepts');
    }

    public function actionMVC()
    {
        return $this->render('m-v-c');
    }

    public function actionModel()
    {
        return $this->render('model');
    }

    public function actionView()
    {
        return $this->render('view');
    }

    public function actionController()
    {
        return $this->render('controller');
    }

    public function actionEvents()
    {
        return $this->render('events');
    }

    public function actionBehaviors()
    {
        return $this->render('behaviors');
    }

    public function actionTesting()
    {
        return $this->render('testing');
    }

    public function actionTheming()
    {
        return $this->render('theming');
    }

    public function actionBootstrapWidgets()
    {
        return $this->render('bootstrap-widgets');
    }

    public function actionHelperClasses()
    {
        return $this->render('helper-classes');
    }

    public function actionModuleDebug()
    {
        return $this->render('module-debug');
    }

    public function actionGii()
    {
        return $this->render('gii');
    }

    public function actionErrorHandling()
    {
        return $this->render('error-handling');
    }

    public function actionLogging()
    {
        return $this->render('logging');
    }

}

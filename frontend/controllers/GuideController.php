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

    public function actionAuthentication()
    {
        return $this->render('authentication');
    }

    public function actionSecurity()
    {
        return $this->render('security');
    }

    public function actionAuthorization()
    {
        return $this->render('authorization');
    }

    public function actionComposer()
    {
        return $this->render('composer');
    }

    public function actionConsole()
    {
        return $this->render('console');
    }

    public function actionWorkingWithForms()
    {
        return $this->render('working-with-forms');
    }

    public function actionUsing3rdPartyLibraries()
    {
        return $this->render('using-3rd-party-libraries');
    }

    public function actionExtendingYii()
    {
        return $this->render('extending-yii');
    }

    public function actionUsingTemplateEngines()
    {
        return $this->render('using-template-engines');
    }

    public function actionDataOverview()
    {
        return $this->render('data-overview');
    }

    public function actionDataProviders()
    {
        return $this->render('data-providers');
    }

    public function actionDataWidgets()
    {
        return $this->render('data-widgets');
    }

    public function actionGrid()
    {
        return $this->render('grid');
    }

    public function actionDatabaseBasics()
    {
        return $this->render('database-basics');
    }

    public function actionQueryBuilder()
    {
        return $this->render('query-builder');
    }

    public function actionActiveRecord()
    {
        return $this->render('active-record');
    }

    public function actionDatabaseMigration()
    {
        return $this->render('database-migration');
    }

    public function actionWhatIsYii()
    {
        return $this->render('what-is-yii');
    }

    public function actionAppsOwn()
    {
        return $this->render('apps-own');
    }

    public function actionAppsBasic()
    {
        return $this->render('apps-basic');
    }

    public function actionInstallation()
    {
        return $this->render('installation');
    }

    public function actionCaching()
    {
        return $this->render('caching');
    }

    public function actionInternationalization()
    {
        return $this->render('internationalization');
    }

    public function actionUrl()
    {
        return $this->render('url');
    }

    public function actionPerformance()
    {
        return $this->render('performance');
    }

    public function actionValidation()
    {
        return $this->render('validation');
    }

    public function actionUpgradeFromV1()
    {
        return $this->render('upgrade-from-v1');
    }

    public function actionAssets()
    {
        return $this->render('assets');
    }

}

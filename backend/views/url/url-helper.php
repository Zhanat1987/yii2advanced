<?php
/**
 * Created by PhpStorm.
 * User: zhanat
 * Date: 05.04.14
 * Time: 7:17
 */
?>
<h1>
    URL помощник
</h1>
<?php
use yii\helpers\Url;
use \common\myhelpers\Debugger;

// currently active route
// /ru/url/url-helper
// если есть доп-ые GET-пар-ры, то их тоже покажет
Debugger::debug(Url::to(''));

// same controller, different action
// /ru/url/index3/p1/2
Debugger::debug(Url::toRoute([
    '/index3',
    'language' => \Yii::$app->language,
    'param1' => 'p1',
    'param2' => 2,
]));

// same module, different controller and action
// /caching/index
Debugger::debug(Url::toRoute('caching/index'));

// absolute route no matter what controller is making this call
// /caching/index
Debugger::debug(Url::toRoute('/caching/index'));

// url for the case sensitive action `actionHiTech` of the current controller
// /index.php?r=management/default/hi-tech
echo Url::toRoute('hi-tech');
echo '<br />';
// url for action the case sensitive controller,
// `DateTimeController::actionFastForward`
// /index.php?r=date-time/fast-forward&id=105
echo Url::toRoute(['/date-time/fast-forward', 'id' => 105]);
echo '<br />';

// get URL from alias
// http://google.com/
Yii::setAlias('@google', 'http://google.com/');
echo Url::to('@google');
echo '<br />';

// get canonical URL for the curent page
// /index.php?r=management/default/users
echo Url::canonical();
echo '<br />';

// get home URL
// /index.php?r=site/index
echo Url::home();
echo '<br />';

Url::remember(); // save URL to be used later
echo Url::previous(); // get previously saved URL
?>
<p>
    URL с хэштегом:<br />
    <?php echo Url::to(['post/read', 'id' => 100, '#' => 'title']); ?>
</p>
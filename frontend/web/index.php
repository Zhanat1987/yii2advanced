<?php

//if (strpos($_SERVER['REQUEST_URI'], 'admin') !== FALSE) {
//    echo 1;
//    exit;
//    header("Location: http://calm-bayou-1695.herokuapp.com/backend/web/index.php");
//} else {
//    echo '<pre>';
//    var_dump($_SERVER['REQUEST_URI']);
//    echo '</pre>';
//}
//$logs = file_get_contents(__DIR__ . '/../../vendor/nginx/logs/error.log');

echo "__DIR__ . '/../../vendor/nginx/logs/error.log'<br />";
echo '<pre>';
var_dump(file_exists(__DIR__ . '/../../vendor/nginx/logs/error.log'));
echo '</pre>';

$logs = file_get_contents(__DIR__ . '/../../vendor/nginx/logs/error.log');
echo '<pre>';
var_dump($logs);
echo '</pre>';

$logs = file(__DIR__ . '/../../vendor/nginx/logs/error.log');
echo '<pre>';
var_dump($logs);
echo '</pre>';
/*
 *
 */
echo "__DIR__ . '/../../vendor/php/var/log/php-errors.log'<br />";
echo '<pre>';
var_dump(file_exists(__DIR__ . '/../../vendor/php/var/log/php-errors.log'));
echo '</pre>';

$logs = file_get_contents(__DIR__ . '/../../vendor/php/var/log/php-errors.log');
echo '<pre>';
var_dump($logs);
echo '</pre>';

$logs = file(__DIR__ . '/../../vendor/php/var/log/php-errors.log');
echo '<pre>';
var_dump($logs);
echo '</pre>';
/*
 *
 */
echo "'/app/vendor/nginx/logs/error.log'<br />";
echo '<pre>';
var_dump(file_exists('/app/vendor/nginx/logs/error.log'));
echo '</pre>';

$logs = file_get_contents('/app/vendor/nginx/logs/error.log');
echo '<pre>';
var_dump($logs);
echo '</pre>';

$logs = file('/app/vendor/nginx/logs/error.log');
echo '<pre>';
var_dump($logs);
echo '</pre>';
/*
 *
 */
echo "'/app/vendor/php/var/log/php-errors.log'<br />";
echo '<pre>';
var_dump(file_exists('/app/vendor/php/var/log/php-errors.log'));
echo '</pre>';

$logs = file_get_contents('/app/vendor/php/var/log/php-errors.log');
echo '<pre>';
var_dump($logs);
echo '</pre>';

$logs = file('/app/vendor/php/var/log/php-errors.log');
echo '<pre>';
var_dump($logs);
echo '</pre>';

/*
 *
 */
echo "__DIR__ . '/../../app/logs/error.log'<br />";
echo '<pre>';
var_dump(file_exists(__DIR__ . '/../../app/logs/error.log'));
echo '</pre>';

$logs = file_get_contents(__DIR__ . '/../../app/logs/error.log');
echo '<pre>';
var_dump($logs);
echo '</pre>';

$logs = file(__DIR__ . '/../../app/logs/error.log');
echo '<pre>';
var_dump($logs);
echo '</pre>';

/*
 *
 */
echo "'/app/logs/error.log'<br />";
echo '<pre>';
var_dump(file_exists('/app/logs/error.log'));
echo '</pre>';

$logs = file_get_contents('/app/logs/error.log');
echo '<pre>';
var_dump($logs);
echo '</pre>';

$logs = file('/app/logs/error.log');
echo '<pre>';
var_dump($logs);
echo '</pre>';

exit;

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../../common/config/aliases.php');

$config = yii\helpers\ArrayHelper::merge(
	require(__DIR__ . '/../../common/config/main.php'),
	require(__DIR__ . '/../../common/config/main-local.php'),
	require(__DIR__ . '/../config/main.php'),
	require(__DIR__ . '/../config/main-local.php')
);

$application = new yii\web\Application($config);
$application->run();

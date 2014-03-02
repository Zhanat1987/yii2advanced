<?php
echo 1;
if (strpos($_SERVER['REQUEST_URI'], 'admin') !== FALSE) {
    header("Location: http://calm-bayou-1695.herokuapp.com//backend/web/index.php");
}
echo 2;
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
echo 3;

require(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../../common/config/aliases.php');
echo 4;

$config = yii\helpers\ArrayHelper::merge(
	require(__DIR__ . '/../../common/config/main.php'),
	require(__DIR__ . '/../../common/config/main-local.php'),
	require(__DIR__ . '/../config/main.php'),
	require(__DIR__ . '/../config/main-local.php')
);
echo 5;

$application = new yii\web\Application($config);
$application->run();
echo 6;

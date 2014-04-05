<?php
/**
 * Created by PhpStorm.
 * User: zhanat
 * Date: 01.04.14
 * Time: 19:58
 */
?>
<a href="<?php echo \Yii::$app->urlManager->createUrl('/url/index2'); ?>">
    url/index2
</a>
<br /><hr /><br />
<a href="<?php echo \Yii::$app->urlManager->createUrl(
    [
        '/url/index2',
        'language' => \Yii::$app->language,
]); ?>">
    url/index2
</a>
<br /><hr /><br />
<a href="<?php echo \Yii::$app->urlManager->createUrl(
    [
        '/url/index3',
        'language' => \Yii::$app->language,
        'param1' => 'p1',
        'param2' => 2,
]); ?>">
    url/index3 с параметрами
</a>
<br /><hr /><br />
<a href="<?php echo \Yii::$app->urlManager->createAbsoluteUrl(
    'url/index2'
); ?>" target="_blank">
    url/index2 - absolute url
</a>
test
<?php
\Yii::$app->on('myEvent', function($event) {
    var_dump($event);
    echo '<h3>Hello from myEvent!!!</h3>';
});
\Yii::$app->trigger('myEvent');
?>
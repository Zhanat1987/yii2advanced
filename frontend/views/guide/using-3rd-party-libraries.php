<h1>
    Использование сторонних библиотек
</h1>
<hr />
<p>
    Yii тщательно разработан таким образом, чтобы сторонние библиотеки могли быть легко интегрированы для дальнейшего расширения функциональности Yii.
</p>
<p>
    TODO: пространства имен и объяснение composer'а
</p>
<h2>
    Использование Yii в сторонних библиотеках
</h2>
<hr />
<p>
    Yii также может использоваться в качестве автономной библиотеки для поддержки развития и укрепления существующих сторонних систем, таких как WordPress, Joomla и т.д. Для этого включают следующий код в загрузочный код в сторонней системе: <br />
    <?php
    highlight_string("<?php
\$yiiConfig = require(__DIR__ . '/../config/yii/web.php');
new yii\\web\\Application(\$yiiConfig); // No 'run()' invocation!
?>");
    ?>
</p>
<p>
    Данный код очень похож на код загрузки, используемой в типичном приложении Yii кроме одной вещи: он не вызывает метод run() после создания экземпляра приложения.
</p>
<p>
    Теперь мы можем использовать большинство возможностей, предлагаемых Yii при разработке усовершенствований в сторонних системах. Например, мы можем использовать Yii::$app для доступа к экземпляру приложения; мы можем использовать функции базы данных, такие как ActiveRecord; мы можем использовать модель и функции проверки и так далее.
</p>
<h2>
    Использование Yii2 с Yii1
</h2>
<hr />
<p>
    Yii2 может использоваться вместе с Yii1 в одном проекте. В Yii2 используются имена класс из пространства имен они не будут конфликтовать с любым классом из Yii1. Однако есть один класс, название которого используется в Yii1 и Yii2, это класс «Yii». Для того чтобы использовать в Yii1 и Yii2 вам нужно решить эту коллизию. Для этого вам необходимо определить свой ​​собственный класс 'Yii', который будет сочетать в себе содержание 'Yii' с 1.x и 'Yii' от 2.x.
</p>
<p>
    При использовании композитора вы должны добавить следующие строки в ваш composer.json, чтобы добавить обе версии Yii в проект:<br />
    <?php
    highlight_string("<?php
\"require\": {
    \"yiisoft/yii\": \"*\",
    \"yiisoft/yii2\": \"*\",
},
?>");
    ?>
</p>
<p>
    Начните с определения собственного потомка от [[yii\BaseYii]]:<br />
    <?php
    highlight_string("<?php
\$yii2path = '/path/to/yii2';
require(\$yii2path . '/BaseYii.php');

class Yii extends \\yii\\BaseYii
{
}

Yii::\$classMap = include(\$yii2path . '/classes.php');
?>");
    ?>
</p>
<p>
    Теперь у нас есть класс, который подходит для Yii2, но вызывает фатальные ошибки для Yii1. Так, в первую очередь, мы должны включить YiiBase из Yii1 исходного кода в наш файл определения класса 'Yii':<br />
    <?php
    highlight_string("<?php
\$yii2path = '/path/to/yii2';
require(\$yii2path . '/BaseYii.php'); // Yii 2.x
\$yii1path = '/path/to/yii1';
require(\$yii1path . '/YiiBase.php'); // Yii 1.x

class Yii extends \\yii\\BaseYii
{
}

Yii::\$classMap = include(\$yii2path . '/classes.php');
?>");
    ?>
</p>
<p>
    Используя это, определяются все необходимые константы и автозагрузчик из Yii1. Теперь нам нужно добавить все поля и методы от YiiBase из Yii1 в класс нашего 'Yii'. К сожалению, нет никакого способа, чтобы сделать это, кроме как copy-paste:<br />
    <?php
    highlight_string("<?php
\$yii2path = '/path/to/yii2';
require(\$yii2path . '/BaseYii.php');
\$yii1path = '/path/to/yii1';
require(\$yii1path . '/YiiBase.php');

class Yii extends \\yii\\BaseYii
{
    public static \$classMap = [];
    public static \$enableIncludePath = true;
    private static \$_aliases = ['system'=>YII_PATH,'zii'=>YII_ZII_PATH];
    private static \$_imports = [];
    private static \$_includePaths;
    private static \$_app;
    private static \$_logger;

    public static function getVersion()
    {
        return '1.1.15-dev';
    }

    public static function createWebApplication(\$config=null)
    {
        return self::createApplication('CWebApplication',\$config);
    }

    public static function app()
    {
        return self::\$_app;
    }

    // Rest of \YiiBase internal code placed here
    ...
}

Yii::\$classMap = include(\$yii2path . '/classes.php');
Yii::registerAutoloader(['Yii', 'autoload']); // Register Yii2 autoloader via Yii1
?>");
    ?>
</p>
<p>
    Примечание: при копировании методы, которые вы не должны были копировать - это метод "autoload()"! Также вы можете избежать копирования "log()", "trace()", "beginProfile()", "endProfile()" в случае, если вы хотите использовать Yii2 отладчик вместо Yii1.
</p>
<p>
    Теперь у нас есть класс 'Yii', который подходит для Yii 1.x и Yii 2.x. Так загрузочный код, используемый в вашем приложении выглядит следующим образом:<br />
    <?php
    highlight_string("<?php
require(__DIR__ . '/../components/my/Yii.php'); // include created 'Yii' class

\$yii2Config = require(__DIR__ . '/../config/yii2/web.php');
new yii\\web\\Application(\$yii2Config); // create Yii 2.x application

\$yii1Config = require(__DIR__ . '/../config/yii1/main.php');
Yii::createWebApplication(\$yii1Config)->run(); // create Yii 1.x application
?>");
    ?>
</p>
<p>
    Тогда в любой части вашей программы Yii::$app относится к Yii 2.x приложению, в то время как Yii::app() относится к Yii 1.x приложению:<br />
    <?php
    highlight_string("<?php
echo get_class(Yii::app()); // outputs 'CWebApplication'
echo get_class(Yii::\$app); // outputs 'yii\\web\\Application'
?>");
    ?>
</p>
<h1>
    Интернационализация
</h1>
<hr />
<p>
    Интернационализация (i18n) относится к процессу проектирования программного приложения таким образом, что она может быть адаптирована к различным языкам и регионам без инженерных изменений. Для веб-приложений это имеет особое значение, так как пользователь может быть в любой точки мира.
</p>
<h2>
    Местоположение и язык
</h2>
<hr />
<p>
    Есть два языка, определенные в приложении Yii: [[yii\base\Application::$sourceLanguage|source language]] и [[yii\base\Application::$language|target language]].
</p>
<p>
    Исходный язык (source language) является языком оригинальных сообщений приложения, написанных, как:<br />
    <?php
    highlight_string("<?php
echo \\Yii::t('app', 'I am a message!');
?>");
    ?>
</p>
<blockquote>
    <p>
        Совет: По умолчанию является английский, не рекомендуется изменять его. Причина в том, что легче найти людей в переводе с английского на любой другой язык, чем с не-английского на не-английские.
    </p>
</blockquote>
<p>
    Целевой язык (target language) - это язый, который используется в настоящее время. Это определено в конфигурации приложения вроде следующего:<br />
    <?php
    highlight_string("<?php
// ...
return [
    'id' => 'applicationID',
    'basePath' => dirname(__DIR__),
    'language' => 'ru-RU' // ← here!
?>");
    ?>
</p>
<p>
    Позже вы можете легко изменить его во время выполнения:<br />
    <?php
    highlight_string("<?php
\\Yii::\$app->language = 'zh-CN';
?>");
    ?>
</p>
<p>
    Форматом является ll-CC, где ll является двух или трех буквенный код языка в нижнем регистре в соответствии с ISO-639 и CC - это код страны в соответствии с ISO-3166.
</p>
<p>
    Если нету перевода для ru-RU, то Yii попытается использовать ru перед отказом.
</p>
<blockquote>
    <p>
        Примечание: Вы можете в дальнейшем настроить язык, указав детали, как описано в проекте ICU.
    </p>
</blockquote>
<h2>
    Перевод сообщений
</h2>
<hr />
<h3>
    Основы
</h3>
<p>
    В Yii основной перевод сообщений в своем базовом варианте работают без дополнительных расширений для PHP. Что Yii делает - находит перевод сообщения от исходного языка в языке перевода. Само сообщение указано в качестве второго параметра метода \Yii::t:<br />
    <?php
    highlight_string("<?php
echo \\Yii::t('app', 'This is a string to translate!');
?>");
    ?>
</p>
<p>
    Yii пытается загрузить соответствующий перевод от одного из источников сообщений, определенных с помощью конфигурации компонента i18n:<br />
    <?php
    highlight_string("<?php
'components' => [
    // ...
    'i18n' => [
        'translations' => [
            'app*' => [
                'class' => 'yii\\i18n\\PhpMessageSource',
                //'basePath' => '@app/messages',
                //'sourceLanguage' => 'en',
                'fileMap' => [
                    'app' => 'app.php',
                    'app/error' => 'error.php',
                ],
            ],
        ],
    ],
],
?>");
    ?>
</p>
<p>
    В приведенном выше коде app* это шаблон, который определяет, какие категории обрабатываются для источника сообщения. В этом случае мы обрабатываем все, что начинается с app. Вы также можете указать перевод по умолчанию, для получения дополнительной информации см. этот пример.
</p>
<p>
    class определяет, какой используется источник сообщения. Следующие источники для сообщений доступны:
</p>
<ul>
    <li>PhpMessageSource - использует PHP файлы.</li>
    <li>GettextMessageSource - использует GNU Gettext МО или PO файлы.</li>
    <li>DbMessageSource - использует базу данных.</li>
</ul>
<p>
    basePath определяет, где хранить сообщения для используемого в данный момент источника сообщений. В данном случае это каталог сообщений в каталоге приложения . В случае использования базы данных этот параметр следует пропустить.
</p>
<p>
    sourceLanguage определяет какой язык используется в \Yii::t для второго аргумента. Если не указано, то исходный язык приложения используется.
</p>
<p>
    fileMap определяет как сообщение категории, указанной в первом аргументе \Yii::t( ) сопоставляется с файлами при использовании PhpMessageSource. В примере мы определяем две категории app и app/error.
</p>
<p>
    Вместо настройки fileMap вы можете рассчитывать на конвенцию, которая является BasePath/messages/LanguageID/CategoryName.php.
</p>
<h3>
    Именованные placeholders'ы (заполнители)
</h3>
<p>
    Вы можете добавить параметры к сообщению перевода, которые будут заменены на соответствующие значения после перевода. Форматом для этого является использование фигурных скобок вокруг имени параметра, как вы можете видеть в следующем примере:<br />
    <?php
    highlight_string("<?php
\$username = 'Alexander';
echo \\Yii::t('app', 'Hello, {username}!', [
    'username' => \$username,
]);
?>");
    ?>
</p>
<p>
    Обратите внимание, что параметр назначается без скобок.
</p>
<h3>
    Позиционные placeholders'ы (заполнители)
</h3>
<?php
highlight_string("<?php
\$sum = 42;
echo \\Yii::t('app', 'Balance: {0}', \$sum);
?>");
?>
<blockquote>
    <p>
        Совет: Попробуйте делать строки сообщений информативными и избегать использования слишком большого количества позиционных параметров. Помните, что переводчик имеет исходную строку, только так должно быть очевидно, о том, что придет на смену каждому заполнителю.
    </p>
</blockquote>
<h3>
    Дополнительное форматирование placeholders'ов (заполнителей)
</h3>
<p>
    Для того чтобы использовать расширенные функции вам нужно установить и включить intl расширение для PHP. После установки и подключения вы сможете использовать расширенный синтаксис для заполнителей. Либо короткая форма {placeholderName, argumentType}, что означает настройку по умолчанию или полный вид {placeholderName, argumentType, argumentStyle}, что позволяет указать стиль форматирования.
</p>
<p>
    Полная ссылка доступна на сайте ICU, но так как это немного загадочно, то мы имеем нашу собственную ссылку ниже.
</p>
<h3>
    Числа
</h3>
<?php
highlight_string("<?php
\$sum = 42;
echo \\Yii::t('app', 'Balance: {0, number}', \$sum);
?>");
?>
<p>
    Вы можете указать один из встроенных стилей (integer - целое число, currency - валюта, percent - процент):<br />
    <?php
    highlight_string("<?php
\$sum = 42;
echo \\Yii::t('app', 'Balance: {0, number, currency}', \$sum);
?>");
    ?>
</p>
<p>
    Или указать пользовательский шаблон:<br />
    <?php
    highlight_string("<?php
\$sum = 42;
echo \\Yii::t('app', 'Balance: {0, number, ,000,000000}', \$sum);
?>");
    ?>
</p>
<a href="http://icu-project.org/apiref/icu4c/classicu_1_1DecimalFormat.html" target="_blank">Ссылка на возможные форматы.</a>
<h3>
    Даты
</h3>
<?php
highlight_string("<?php
echo \\Yii::t('app', 'Today is {0, date}', time());
?>");
?>
<p>
    Встроенные форматы (short, medium, long, full):<br />
    <?php
    highlight_string("<?php
echo \\Yii::t('app', 'Today is {0, date, short}', time());
?>");
    ?>
</p>
<p>
    Пользовательский шаблон:<br />
    <?php
    highlight_string("<?php
echo \\Yii::t('app', 'Today is {0, date, YYYY-MM-dd}', time());
?>");
    ?>
</p>
<a href="http://icu-project.org/apiref/icu4c/classicu_1_1SimpleDateFormat.html" target="_blank">Ссылка на возможные форматы.</a>
<h3>
    Время
</h3>
<?php
highlight_string("<?php
echo \\Yii::t('app', 'It is {0, time}', time());
?>");
?>
<p>
    Встроенные форматы (short, medium, long, full):<br />
    <?php
    highlight_string("<?php
echo \\Yii::t('app', 'It is {0, time, short}', time());
?>");
    ?>
</p>
<p>
    Пользовательский шаблон:<br />
    <?php
    highlight_string("<?php
echo \\Yii::t('app', 'It is {0, date, HH:mm}', time());
?>");
    ?>
</p>
<a href="http://icu-project.org/apiref/icu4c/classicu_1_1SimpleDateFormat.html" target="_blank">Ссылка на возможные форматы.</a>
<h3>
    Spellout (spell out - расшифровать)
</h3>
<?php
highlight_string("<?php
echo \\Yii::t('app', '{n,number} is spelled as {n, spellout}', ['n' => 42]);
?>");
?>
<h3>
    Ordinal
</h3>
<?php
highlight_string("<?php
echo \\Yii::t('app', 'You are {n, ordinal} visitor here!', ['n' => 42]);
?>");
?>
<p>
    Будет возвращать - "Вы 42-й посетитель!".
</p>
<h3>
    Duration
</h3>
<?php
highlight_string("<?php
echo \\Yii::t('app', 'You are here for {n, duration} already!', ['n' => 47]);
?>");
?>
<p>
    Будет возвращать - "Вы здесь уже 47 сек.!".
</p>
<h3>
    Plurals (Множественное)
</h3>
<p>
    Разные языки имеют различные способы, чтобы склонять во множественном числе. Некоторые правила очень сложны, поэтому очень удобно, что эта функция обеспечивается без необходимости определения правил склонения. Вместо этого он требует только указание склоняемого слова в определенных ситуациях.<br />
    <?php
    highlight_string("<?php
echo \\Yii::t('app', 'There {n, plural, =0{are no cats} =1{is one cat} other{are # cats}}!', ['n' => 0]);
?>");
    ?>
</p>
<p>
    Вернет нам "There are no cats!".
</p>
<p>
    Во множественном правиле аргументы выше =0 означает в точности равно нулю, =1 означает ровно один другой для любого другого числа. # заменяется на значение аргумента n. Это не так то просто для других языков, кроме английского. Вот пример для русского языка:<br />
    <?php
    highlight_string("<?php
Здесь {n, plural, =0{котов нет} =1{есть один кот} one{# кот} few{# кота} many{# котов} other{# кота}}!
?>");
    ?>
</p>
<p>
    В вышесказанном стоит отметить, что =1 соответствует ровно n = 1, в то время как 'one' соответствует 21 или 101.
</p>
<p>
    Обратите внимание, что если вы используете заполнитель дважды и один раз он используется в качестве множественного, другой следует использовать в качестве числа, то вы получите ошибку "Inconsistent types declared for an argument: U_ARGUMENT_TYPE_MISMATCH":<br />
    <?php
    highlight_string("<?php
Total {count, number} {count, plural, one{item} other{items}}.
?>");
    ?>
</p>
<p>
    Чтобы узнать, какие падежи необходимо указать для вашего языка вы можете посмотреть правила в unicode.org.
</p>
<h3>
    Selections (Выборы)
</h3>
<p>
    Вы можете выбрать фразы на основе ключевых слов. pattern в этом случае определяет, как отобразить слово для фраз и обеспечивает фразу по умолчанию.<br />
    <?php
    highlight_string("<?php
echo \\Yii::t('app', '{name} is {gender} and {gender, select, female{she} male{he} other{it}} loves Yii!', [
    'name' => 'Snoopy',
    'gender' => 'dog',
]);
?>");
    ?>
</p>
<p>
    Вернет вам "Snoopy is dog and it loves Yii!".
</p>
<p>
    В выражении female и male являются возможными значениями. other значения обработчика при не совпадении. Строки внутри скобок подвыражения так может быть только строкой или строкой с большим числом заполнителей.
</p>
<h3>
    Указание перевода по умолчанию
</h3>
<p>
    Вы можете задать перевод по умолчанию, который будет использоваться в качестве запасного варианта для категорий, которые не соответствуют любому другому переводу. Этот перевод должен быть, отмечен *. Для того, чтобы сделать это, добавьте следующие строки в файле конфигурации (для yii2 базового приложения будет web.php):<br />
    <?php
    highlight_string("<?php
//configure i18n component

'i18n' => [
    'translations' => [
        '*' => [
            'class' => 'yii\\i18n\\PhpMessageSource'
        ],
    ],
],
?>");
    ?>
</p>
<p>
    Теперь вы можете использовать категории без настройки каждой из них, это похоже на behavior в Yii 1.1. Сообщения для категории будут загружены из файла перевода по умолчанию в директории basePath, который задан как @app/messages:<br />
    <?php
    highlight_string("<?php
echo Yii::t('not_specified_category', 'message from unspecified category');
?>");
    ?>
</p>
<p>
    Сообщение будет загружаться из @app/messages/<?php highlight_string("<?php <LanguageCode> ?>"); ?>/not_specified_category.php.
</p>
<h3>
    Перевод сообщений модуля
</h3>
<p>
    Если вы хотите перевести сообщения для модуля и избежать использования одного файла перевода для всех сообщений, то вы можете сделать это так:<br />
    <?php
    highlight_string("<?php
<?php

namespace app\\modules\\users;

use Yii;

class Module extends \\yii\\base\\Module
{
    public \$controllerNamespace = 'app\\modules\\users\\controllers';

    public function init()
    {
        parent::init();
        \$this->registerTranslations();
    }

    public function registerTranslations()
    {
        Yii::\$app->i18n->translations['modules/users/*'] = [
            'class' => 'yii\\i18n\\PhpMessageSource',
            'sourceLanguage' => 'en',
            'basePath' => '@app/modules/users/messages',
            'fileMap' => [
                'modules/users/validation' => 'validation.php',
                'modules/users/form' => 'form.php',
                ...
            ],
        ];
    }

    public static function t(\$category, \$message, \$params = [], \$language = null)
    {
        return Yii::t('modules/users/' . \$category, \$message, \$params, \$language);
    }

}
?>");
    ?>
</p>
<p>
    В приведенном выше примере мы используем шаблон для согласования, а затем соотносим каждую категорию на нужный файл. Вместо того чтобы использовать fileMap вы можете просто использовать конвенцию категории соответствия с тем же именем файла и использовать непосредственно Module::t('validation', 'your custom validation message') или Module::t('form', 'some form label').
</p>
<h3>
    Перевод сообщений виджета
</h3>
<p>
    Те же правила могут быть применены для виджетов, например:<br />
    <?php
    highlight_string("<?php
<?php

namespace app\\widgets\\menu;

use yii\\base\\Widget;
use Yii;

class Menu extends Widget
{

    public function init()
    {
        parent::init();
        \$this->registerTranslations();
    }

    public function registerTranslations()
    {
        \$i18n = Yii::\$app->i18n;
        \$i18n->translations['widgets/menu/*'] = [
            'class' => 'yii\\i18n\\PhpMessageSource',
            'sourceLanguage' => 'en',
            'basePath' => '@app/widgets/menu/messages',
            'fileMap' => [
                'widgets/menu/messages' => 'messages.php',
            ],
        ];
    }

    public function run()
    {
        echo \$this->render('index');
    }

    public static function t(\$category, \$message, \$params = [], \$language = null)
    {
        return Yii::t('widgets/menu/' . \$category, \$message, \$params, \$language);
    }

}
?>");
    ?>
</p>
<p>
    Вместо того чтобы использовать fileMap вы можете просто использовать конвенцию категории соответствия с тем же именем файла и использовать непосредственно Menu::t('messages', 'new messages {messages}', ['{messages}' => 10]).
</p>
<blockquote>
    <p>
        Примечание: Для виджетов вы можете также использовать представления i18n, те же правила, что и для контроллеров применяются к ним тоже.
    </p>
</blockquote>
<h2>
    Представления
</h2>
<hr />
<p>
    Вы можете использовать i18n в ваших представлениях, чтобы обеспечить поддержку различных языков. Например, если у вас есть views/site/index.php и вы хотите создать особый перевод в русском языке, вы создаете папку ru-RU в папке представления текущего контроллера/виджета и положите туда файл с переводом на русском языке views/site/ru-RU/index.php.
</p>
<blockquote>
    <p>
        Примечание: Если язык указан как en-US и нет соответствующего представления, то Yii будет искать представления в en, прежде чем использовать оригинальные.
    </p>
</blockquote>
<h2>
    i18n formatter
</h2>
<hr />
<p>
    i18n formatter - этот компонент является локализованной версией форматирования, который поддерживает форматирование даты, времени и чисел на основе текущей локали. Для того, чтобы использовать его необходимо настроить компонент приложения форматирования следующим образом:<br />
    <?php
    highlight_string("<?php
return [
    // ...
    'components' => [
        'formatter' => [
            'class' => 'yii\\i18n\\Formatter',
        ],
    ],
];
?>");
    ?>
</p>
<p>
    После настройки компонент может быть доступен как Yii::$app->formatter.
</p>
<p>
    Обратите внимание, что для того, чтобы использовать i18n formatter, необходимо установить и включить intl расширение для PHP.
</p>
<p>
    Для того, чтобы узнать о методах форматирования, обратитесь к его API документации: [[yii\i18n\Formatter]].
</p>
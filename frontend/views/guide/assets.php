<h1>
    Управление assets'ами
</h1>
<hr />
<p>
    Asset в Yii это файл, который подключается к странице. Это может быть CSS, JavaScript или любой другой файл. Фреймворк предоставляет множество способов работы с assets'ами начиная с базовых функций, такие как добавление <?php highlight_string("<?php <script src=\"...\"> ?>"); ?> тега для файла, который описан в разделе Вид, заканчивая расширенным функционалом - подключение файлов, которые не находятся в корневой директории веб-сервера, разрешения зависимостей JavaScript или сжатие CSS, которое мы рассмотрим далее.
</p>
<h2>
    Объявление asset bundles'ов (пучки активов)
</h2>
<hr />
<p>
    Для того чтобы определить набор assets'ов, которые должны быть вместе и должны использоваться на веб-сайте, вы объявляете класс с именем "asset bundle". bundle определяет набор файлов assets'ов и их зависимости от других asset bundles'ов.
</p>
<p>
    Asset файлы могут быть расположены в каталоге доступном для веб-сервера, но скрытые внутри приложения или в vendor каталоге. Если последнее, то asset bundle будет заботиться о публикации их в директории доступной для веб-сервера, чтобы они могли быть подключены к веб-сайту. Эта функция полезна для расширений, так что они могут грузить весь контент в одном каталоге и сделать установку проще для вас.
</p>
<p>
    Чтобы определить asset создается класс, наследуемый от [[yii\web\AssetBundle]] и устанавливаются свойства в соответствии с вашими потребностями. Здесь вы можете увидеть пример определения asset'а, который является частью базового шаблона приложения, в классе asset bundle'а AppAsset. Он определяет assets'ы, необходимые приложению:<br />
    <?php
    highlight_string("<?php
<?php

use yii\\web\\AssetBundle as AssetBundle;

class AppAsset extends AssetBundle
{
    public \$basePath = '@webroot';
    public \$baseUrl = '@web';
    public \$css = [
        'css/site.css',
    ];
    public \$js = [
    ];
    public \$depends = [
        'yii\\web\\YiiAsset',
        'yii\\bootstrap\\BootstrapAsset',
    ];
}
?>");
    ?>
</p>
<p>
    В приведенном выше коде $basePath определяет веб-доступный каталог, с которого начинается базовый путь к файлам, указанным в $css и $js, например - @webroot/css/site.css для css/site.css. Здесь @webroot - это псевдоним, который указывает на веб-каталог приложения.
</p>
<p>
    $baseUrl используется для указания базового URL, для того же $css и $js, т.е. @web/css/site.css, где @web является псевдонимом, который соответствует вашему базовому URL сайта, например - http://example.com/.
</p>
<p>
    В случае, если у вас есть asset файлы в не доступной веб директории, то как и в случае с любым extension'ом, необходимо указать $sourcePath вместо $basePath и $baseUrl. Файлы будут копироваться или являться символическими ссылками на исходный путь к каталогу web/assets вашего приложения до регистрации. В этом случае $basePath и $baseUrl генерируются автоматически в момент публикации asset bundle'ов.
</p>
<p>
    Зависимости от других asset bundle'ов задаются через свойство $depends. Это массив, который содержит полные квалифицированные имена классов, которые должны быть опубликованы для того, чтобы этот bundle работал должным образом. Javascript и CSS файлы для AppAsset добавляются в header после файлов из  [[yii\web\YiiAsset]] и [[yii\bootstrap\BootstrapAsset]] в этом примере.
</p>
<p>
    Здесь [[yii\web\YiiAsset]] добавляет библиотеку Yii в JavaScript, в то время как [[yii\bootstrap\BootstrapAsset]] включает Bootstrap фреймворк для внешнего интерфейса.
</p>
<p>
    Asset bundles - это регулярные классы, так что если вам нужно определить еще, то надо создать класс с уникальным именем. Этот класс может быть размещен где угодно, но конвенция для него должна быть в подкаталоге ресурсов приложения.
</p>
<p>
    Кроме того, вы можете указать $jsOptions, $cssOptions и $publishOptions, которые будут переданы в [[yii\web\View::registerJsFile()]], [[yii\web\View::registerCssFile()]] и [[yii\web\AssetManager::publish()]] соответственно при регистрации и публикации asset'ов.
</p>
<h3>
    Специфичные для текущего языка приложения asset bundle'ы
</h3>
<p>
    Если вам нужно определить asset bundle, который включает файл JavaScript в зависимости от языка, то вы можете сделать это следующим образом:<br />
    <?php
    highlight_string("<?php
class LanguageAsset extends AssetBundle
{
    public \$language;
    public \$sourcePath = '@app/assets/language';
    public \$js = [
    ];

    public function registerAssetFiles(\$view)
    {
        \$language = \$this->language ? \$this->language : Yii::\$app->language;
        \$this->js[] = 'language-' . \$language . '.js';
        parent::registerAssetFiles(\$view);
    }
}
?>");
    ?>
</p>
<p>
    Для того, чтобы установить язык надо использовать следующий код при регистрации asset bundle'ов в представлении:<br />
    <?php
    highlight_string("<?php
LanguageAsset::register(\$this)->language = \$language;
?>");
    ?>
</p>
<h2>
    Регистрация asset bundle'ов
</h2>
<hr />
<p>
    Asset bundle классы, как правило, зарегистрированы в файлах представлений или виджетах, которые зависят от CSS или JavaScript файлов для обеспечения его функциональности. Исключением из этого правила является класс AppAsset, определенный выше, который добавляется в основной макет приложения, чтобы быть доступным на любой странице приложения. Регистрировать asset bundle'ы так же просто, просто вызовите метод [[yii\web\AssetBundle::register()|register()]]:<br />
    <?php
    highlight_string("<?php
use app\\assets\\AppAsset;
AppAsset::register(\$this);
?>");
    ?>
</p>
<p>
    Так как мы находимся в контексте представления, то $this ссылается на класс View. Для регистрации asset'а внутри виджета, экземпляру представления доступно как $this->view:<br />
    <?php
    highlight_string("<?php
AppAsset::register(\$this->view);
?>");
    ?>
</p>
<blockquote>
    <p>
        Примечание: Если есть необходимость изменить чужие (от третьих лиц) asset bundles'ы, то рекомендуется создавать свои собственные bundles'ы, которые будут зависеть от чужих bundles'ов и использовать CSS и JavaScript особенности для изменения поведения вместо редактирования файлов непосредственно или их копирования.
    </p>
</blockquote>
<h2>
    Переопределение некоторых asset bundles'ов
</h2>
<hr />
<p>
    Иногда вам необходимо переопределить некоторые asset bundles'ы приложения в ширину. Хорошим примером считается загрузка JQuery из CDN вместо загрузки с вашего собственного сервера. Для того, чтобы сделать это нам нужно настроить компонент приложения assetManager через конфигурационный файл. В случае базового приложения это config/web.php:<br />
    <?php
    highlight_string("<?php
return [
    // ...
    'components' => [
        'assetManager' => [
            'bundles' => [
                'yii\\web\\JqueryAsset' => [
                     'sourcePath' => null,
                     'js' => ['//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js']
                ],
            ],
        ],
    ],
];
?>");
    ?>
</p>
<p>
    Выше мы добавляем определения asset bundle в свойстве [[yii\web\AssetManager::bundles|bundles]] asset менеджера. Ключи полностью квалифицируют имена класса для объединения asset bundle'ов класса, которые мы хотим переопределить пока значения ассоциативного массива свойств класса и соответствующих значений, чтобы установить.
</p>
<p>
    Установка sourcePath в null говорит asset менеджеру не копировать ничего пока JS перекрывает локальные файлы со ссылкой на CDN.
</p>
<h2>
    Включение символических ссылок
</h2>
<hr />
<p>
    Asset менеджер может использовать символические ссылки вместо копирования файлов. Это отключено по умолчанию, так как символические ссылки часто отключены на виртуальном хостинге. Если среда вашего хостинга поддерживает символические ссылки, то вы, безусловно, должны включить эту функцию в конфигурации приложения:<br />
    <?php
    highlight_string("<?php
return [
    // ...
    'components' => [
        'assetManager' => [
            'linkAssets' => true,
        ],
    ],
];
?>");
    ?>
</p>
<p>
    Есть два основных преимущества в включении символических ссылок. Первое - это работает быстрее, так как нет никакого копирования и, во-вторых то, что assets'ы всегда будут подключать актуальные версии файла с источника.
</p>
<h2>
    Сжатие и объединение assets'ов
</h2>
<hr />
<p>
    Для повышения производительности приложений вы можете сжимать, а затем объединять несколько CSS или JS-файлов в меньшее количество файлов тем самым уменьшая число запросов и общий размер загрузки, необходимый для загрузки веб-страницы. Yii обеспечивает консольную команду, которая позволяет сделать оба этих действия.
</p>
<h3>
    Подготовка конфигурации
</h3>
<p>
    Для того чтобы использовать asset команду, вы должны подготовить конфигурацию в первую очередь. Шаблон для него может быть создан с помощью<br />
    <?php
    highlight_string("<?php
yii asset/template /path/to/myapp/config.php
?>");
    ?>
</p>
<p>
    Сам шаблон выглядит следующим образом:<br />
    <?php
    highlight_string("<?php
<?php
/**
 * Configuration file for the \"yii asset\" console command.
 * Note that in the console environment, some path aliases like '@webroot' and '@web' may not exist.
 * Please define these missing path aliases.
 */
return [
    // The list of asset bundles to compress:
    'bundles' => [
        // 'yii\\web\\YiiAsset',
        // 'yii\\web\\JqueryAsset',
    ],
    // Asset bundle for compression output:
    'targets' => [
        'app\\config\\AllAsset' => [
            'basePath' => 'path/to/web',
            'baseUrl' => '',
            'js' => 'js/all-{ts}.js',
            'css' => 'css/all-{ts}.css',
        ],
    ],
    // Asset manager configuration:
    'assetManager' => [
        'basePath' => __DIR__,
        'baseUrl' => '',
    ],
];
?>");
    ?>
</p>
<p>
    Приведенные выше ключи являются свойствами AssetController. bundles Список содержит bundles, которые необходимо сжать. Они, как правило используются приложением. цели содержат список bundles'ов, которые определяют, как в результате файлы будут записаны. В нашем случае мы пишем все в path/to/web, который может быть доступен как http://example.com/, т.е. корневой каталог сайта.
</p>
<blockquote>
    <p>
        Примечание: в консольной среде некоторые псевдонимы пути, такие как '@webroot' и '@web' могут не существовать, тогда соответствующие пути внутри конфигурации должны быть указаны непосредственно.
    </p>
</blockquote>
<p>
    Файлы JavaScript объединяются, сжимаются и записываются в js/all-{ts}.js, где {ts} заменяется на текущую метку времени.
</p>
<h3>
    Предоставление инструментов сжатия
</h3>
<p>
    Команда полагается на внешние инструменты сжатия, которые не входят в комплект с Yii, чтобы обеспечить CSS и JS компрессоры, которые соответственно указаны в свойствах cssCompressor и jsCompression. Если компрессор задан в виде строки, то он рассматривается как шаблон командной оболочки, которая должна содержать два placeholders'а: {from} - заменяется именем исходного файла и {to} - заменяется именем выходного файла. Другой способ указать компрессор - это использование любого валидного PHP callback'а.
</p>
<p>
    По умолчанию для сжатия JavaScript Yii пытается использовать компилятор Google Closure, ожидается, что он будет в файле с именем compiler.jar.
</p>
<p>
    Для сжатия CSS Yii предполагает, что YUI компрессор ищется в файле с именем yuicompressor.jar.
</p>
<p>
    Для того, чтобы сжать оба JavaScript и CSS, вам необходимо скачать оба инструмента и разместить их в директории, содержащей ваш загрузочный файл для консоли yii. Кроме того, необходимо установить JRE для запуска этих инструментов.
</p>
<p>
    Вы можете настроить команды сжатия (например, изменените расположение jar файлов) в файле config.php как в примере ниже<br />
    <?php
    highlight_string("<?php
return [
    'cssCompressor' => 'java -jar path.to.file\\yuicompressor.jar  --type css {from} -o {to}',
    'jsCompressor' => 'java -jar path.to.file\\compiler.jar --js {from} --js_output_file {to}',
];
?>");
    ?>
</p>
<p>
    где {from} и {to} являются тоенами, которые будут заменены на фактический источник и цель пути к файлам соответственно, когда asset команда сожмет каждый файл.
</p>
<h3>
    Выполнение сжатия
</h3>
<p>
    После настройки конфигурации вы можете запустить действие compress, используя созданную конфигурации:<br />
    <?php
    highlight_string("<?php
yii asset /path/to/myapp/config.php /path/to/myapp/config/assets_compressed.php
?>");
    ?>
</p>
<p>
    Теперь обработка занимает некоторое время и наконец завершается. Вам нужно настроить вашу веб-конфигурацию приложения, чтобы использовать сжатые assets'ы следующим образом:<br />
    <?php
    highlight_string("<?php
'components' => [
    // ...
    'assetManager' => [
        'bundles' => require '/path/to/myapp/config/assets_compressed.php',
    ],
],
?>");
    ?>
</p>
<h2>
    Использование преобразователя asset'ов
</h2>
<hr />
<p>
    Вместо того чтобы использовать CSS и JavaScript непосредственно, разработчики часто используют свои улучшенные версии, такие как LESS или SCSS для CSS или Microsoft TypeScript для JavaScript. Использовать их с Yii легко.
</p>
<p>
    Прежде всего, соответствующие средства сжатия должны быть установлены и должны быть доступны из файла начальной загрузки для консоли yii. Ниже перечислены расширения файлов и соответствующие им имена инструментов преобразования, которые признает Yii converter:
</p>
<ul>
    <li>LESS: <code>less</code> - <code>lessc</code>
    </li>
    <li>SCSS: <code>scss</code>, <code>sass</code> - <code>sass</code>
    </li>
    <li>Stylus: <code>styl</code> - <code>stylus</code>
    </li>
    <li>CoffeeScript: <code>coffee</code> - <code>coffee</code>
    </li>
    <li>TypeScript: <code>ts</code> - <code>tsc</code>
    </li>
</ul>
<p>
    Так что, если установлен соответствующий инструмент, который можно указать любому из этих asset bundle'ов:<br />
    <?php
    highlight_string("<?php
class AppAsset extends AssetBundle
{
    public \$basePath = '@webroot';
    public \$baseUrl = '@web';
    public \$css = [
        'css/site.less',
    ];
    public \$js = [
        'js/site.ts',
    ];
    public \$depends = [
        'yii\\web\\YiiAsset',
        'yii\\bootstrap\\BootstrapAsset',
    ];
}
?>");
    ?>
</p>
<p>
    Для того, чтобы настроить параметры вызова инструмента преобразования или добавить новые инструменты, то для этого можно использовать настройки приложения:<br />
    <?php
    highlight_string("<?php
// ...
'components' => [
    'assetManager' => [
        'converter' => [
            'class' => 'yii\\web\\AssetConverter',
            'commands' => [
                'less' => ['css', 'lessc {from} {to} --no-color'],
                'ts' => ['js', 'tsc --out {to} {from}'],
            ],
        ],
    ],
],
?>");
    ?>
</p>
<p>
    Выше мы оставили два типа дополнительных расширений файлов. Первый - это less, который можно указать в css части asset bundle'а. Преобразование осуществляется с помощью запуска команды <code>lessc {from} {to} --no-color</code>, где {from} заменяется LESS путем к файлу, в то время как {to} заменяется заданной траекторией CSS файла. Во-вторых - это ts, которые могут быть указаны в js части asset bundle'а. Команда, которая запущена во время преобразования находится в том же формате, который используется для less.
</p>
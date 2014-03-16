<h1>
    Управление URL
</h1>
<hr />
<p>
    Концепция управления URL в Yii довольно проста. Управление URL основано на предпосылке, что приложение везде использует внутренние маршруты и параметры. Сам фреймворк будет переводить маршруты в URL-адреса, и наоборот, в зависимости от конфигурации URL менеджера. Такой подход позволяет изменять URL-адреса веб-узла только путем редактирования одного файла конфигурации не касаясь кода приложения.
</p>
<h2>
    Внутренние маршруты
</h2>
<hr />
<p>
    При реализации приложения с помощью Yii, вы будете иметь дело с внутренними маршрутами, часто упоминаются как маршруты и параметры. Каждый контроллер и действие контроллера имеет соответствующий внутренний маршрут например site/index или user/create. В первом примере, site - это id контроллера, в то время как index - это id действия. Во втором примере, user - это id контроллера, в то время как create - это id действия. Если контроллер принадлежит модулю, то внутренний маршрут будет с префиксом id модуля. Например blog/post/index для модуля blog (post - это id контроллера, index - это id действия).
</p>
<h2>
    Создание URL-адресов
</h2>
<hr />
<p>
    Самое главное правило для создания URL-адреса на своем сайте - всегда делать это с помощью менеджера URL. Менеджер URL является встроенным компонентом приложения по имени urlManager. Этот компонент доступен из веб и консольных приложений с помощью \Yii::$app->urlManager. Компонент делает доступным два следующих метода для создания URL:
</p>
<ul>
    <li><code>createUrl($params)</code></li>
    <li><code>createAbsoluteUrl($params, $schema = null)</code></li>
</ul>
<p>
    Метод createUrl создает URL относительно корня приложения, такие как /index.php/site/index/. Метод createAbsoluteUrl создает URL с префиксом надлежащего протокола и именем хоста: http://www.example.com/index.php/site/index. Первый пригоден для внутренних адресов приложений, а второй используется, когда необходимо создать URL-адреса для внешних ресурсов, таких как подключение к сторонним услугам, отправка электронной почты, создание RSS-канала и т.д.
</p>
<p>
    Вот некоторые примеры:<br />
    <?php
    highlight_string("<?php
echo \\Yii::\$app->urlManager->createUrl(['site/page', 'id' => 'about']);
// /index.php/site/page/id/about/
echo \\Yii::\$app->urlManager->createUrl(['date-time/fast-forward', 'id' => 105])
// /index.php?r=date-time/fast-forward&id=105
echo \\Yii::\$app->urlManager->createAbsoluteUrl('blog/post/index');
// http://www.example.com/index.php/blog/post/index/
?>");
    ?>
</p>
<p>
    Точный формат URL зависит от того, как настроен URL менеджер. Приведенные выше примеры могут также выводить:
</p>
<ul>
    <li><code>/site/page/id/about/</code></li>
    <li><code>/index.php?r=site/page&amp;id=about</code></li>
    <li><code>/index.php?r=date-time/fast-forward&amp;id=105</code></li>
    <li><code>/index.php/date-time/fast-forward?id=105</code></li>
    <li><code>http://www.example.com/blog/post/index/</code></li>
    <li><code>http://www.example.com/index.php?r=blog/post/index</code></li>
</ul>
<p>
    В целях упрощения создания URL есть помощник [[yii\helpers\Url]]. Предположим, что мы находимся в /index.php?r=management/default/users&id=10. Ниже показано как работает Url помощник:<br />
    <?php
    highlight_string("<?php
use yii\\helpers\\Url;

// currently active route
// /index.php?r=management/default/users
echo Url::to('');

// same controller, different action
// /index.php?r=management/default/page&id=contact
echo Url::toRoute(['page', 'id' => 'contact']);


// same module, different controller and action
// /index.php?r=management/post/index
echo Url::toRoute('post/index');

// absolute route no matter what controller is making this call
// /index.php?r=site/index
echo Url::toRoute('/site/index');

// url for the case sensitive action `actionHiTech` of the current controller
// /index.php?r=management/default/hi-tech
echo Url::toRoute('hi-tech');

// url for action the case sensitive controller, `DateTimeController::actionFastForward`
// /index.php?r=date-time/fast-forward&id=105
echo Url::toRoute(['/date-time/fast-forward', 'id' => 105]);

// get URL from alias
// http://google.com/
Yii::setAlias('@google', 'http://google.com/');
echo Url::to('@google');

// get canonical URL for the curent page
// /index.php?r=management/default/users
echo Url::canonical();

// get home URL
// /index.php?r=site/index
echo Url::home();

Url::remember(); // save URL to be used later
Url::previous(); // get previously saved URL
?>");
    ?>
</p>
<blockquote>
    <p>
        Совет: Для того, чтобы генерировать URL с хэштегом, например /index.php?r=site/page&id=100#title, необходимо указать параметр с именем #: Url::to(['post/read', 'id' => 100, '#' => 'title']).
    </p>
</blockquote>
<h2>
    Настройка URL-адресов
</h2>
<hr />
<p>
    По умолчанию Yii использует формат строки запроса для URL-адресов, таких как /index.php?r=news/view&id=100. Для того, чтобы URL-адреса были человеко-понятными, т.е. более читабельным, необходимо настроить компонент urlManager в файле конфигурации приложения. Включение "красивых" URL-адресов будет конвертировать формат строки запроса в формат на основе директорий: /index.php/news/view?id=100. Отключение параметра showScriptName означает, что index.php не будет указан в URL-адресе. Вот соответствующая часть файла конфигурации приложения:<br />
    <?php
    highlight_string("<?php
<?php
return [
    // ...
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
    ],
];
?>");
    ?>
</p>
<p>
    Обратите внимание, что эта конфигурация будет работать только если веб-сервер был правильно настроен для Yii, смотрите более подробно в разделе Установка.
</p>
<h3>
    Именованные параметры
</h3>
<p>
    Правило может быть связано с несколькими GET параметрами. Эти GET параметры появляются в шаблоне правила, как специальные tokens'ы в следующем формате:<br />
    <?php
    highlight_string("<?php
<ParameterName:ParameterPattern>
?>");
    ?>
</p>
<p>
    ParameterName - это имя GET параметра, и дополнительный ParameterPattern - это регулярное выражение, которое следует использовать в соответствии со значением GET параметра. В случае если ParameterPattern пропущен, то это означает, что параметр должен соответствовать любым символам, кроме '/'. При создании URL эти tokens'ы будут заменены на соответствующие значения параметров, при разборе URL, соответствующие GET параметры будут заполняться результатами разбора.
</p>
<p>
    Давайте используем некоторые примеры, чтобы объяснить, как работают правила URL. Будем считать, что наш набор правил состоит из трех правил:<br />
    <?php
    highlight_string("<?php
[
    'posts'=>'post/list',
    'post/<id:\\d+>'=>'post/read',
    'post/<year:\\d{4}>/<title>'=>'post/read',
]
?>");
    ?>
</p>
<ul>
    <li>Вызов Url::toRoute('post/list') генерирует /index.php/posts. Первое правило применяется.</li>
    <li>Вызов Url::toRoute(['post/read', 'id' => 100]) генерирует /index.php/post/100. Второе правило применяется.</li>
    <li>Вызов Url::toRoute(['post/read', 'year' => 2008, 'title' => 'a sample post']) генерирует /index.php/post/2008/a%20sample%20post. Третье правило применяется.</li>
    <li>Вызов Url::toRoute('post/read') генерирует /index.php/post/read. Ни одно из правил не применяется, используется соглашение правила по умолчанию</li>
</ul>
<p>
    В итоге, при использовании createUrl генерируется URL, маршрут и GET параметры, переданные в метод и используемые для решения того какое правило URL должно быть применено. Если каждый параметр ассоциирумый с правилом может быть найден в GET параметрах, переданных в createUrl, и если маршрут для правила так же соответствует параметру маршрута, то правило будет использовано для генерации URL.
</p>
<p>
    Если GET параметров переданных в Url::toRoute больше, чем требуется для правила, то дополнительные параметры появятся в строке запроса. Например, если мы вызовем Url::toRoute(['post/read', 'id' => 100, 'year' => 2008]), то мы получим /index.php/post/100?year=2008.
</p>
<p>
    Как мы упоминали ранее, другая цель в правилах URL - проанализировать запрос URL-адреса. Естественно, это обратный процесс создания URL. Например, когда пользователь запрашивает /index.php/post/100, второе правило в примере выше будет применяться, которое разрешено в маршруте post/read и GET параметр ['id' => 100] (доступен с помощью Yii::$app->request->get('id')).
</p>
<h3>
    Параметризованные маршруты
</h3>
<p>
    Мы можем ссылаться на именованные параметры в маршруте в части правила. Это позволяет правилу быть примененным к нескольким маршрутам на основе сопоставления критериев. Он также может помочь уменьшить количество необходимых правил для приложения, и, таким образом улучшить общую производительность.
</p>
<p>
    Мы используем следующий набор правил для иллюстрации параметризованных маршрутов с именованными параметрами:<br />
    <?php
    highlight_string("<?php
[
    '<controller:(post|comment)>/<id:\\d+>/<action:(create|update|delete)>' => '<controller>/<action>',
    '<controller:(post|comment)>/<id:\\d+>' => '<controller>/read',
    '<controller:(post|comment)>s' => '<controller>/list',
]
?>");
    ?>
</p>
<p>
    В приведенном выше примере, мы использовали два именованных параметра в правилах маршрутов: контроллер и действие. controller - соответствует id контроллера, может быть либо post, либо comment, а второй совпадает с id действия для create, update или delete. Вы можете называть параметры по-другому, если они не противоречат параметрам GET, которые могут появиться в URL.
</p>
<p>
    Используя приведенные выше правила, URL /index.php/post/123/create будет разбираться, как маршрут post/create с GET параметром id=123. Учитывая маршрут comment/list и GET параметр page=2, мы можем создать URL /index.php/comments?page=2.
</p>
<h3>
    Конфигурирование хостов
</h3>
<p>
    Кроме того, можно включить имена хостов в правила для разбора и создания URL-адресов. Можно выделить часть имени хоста как GET параметр. Это особенно полезно для обработки суб-доменов. Например, URL http://admin.example.com/en/profile может быть разобрано в GET параметры user=admin и lang=en. С другой стороны, правила с именем хоста также могут быть использованы для создания URL-адреса с параметризованным именем хоста.
</p>
<p>
    Для того чтобы использовать параметризованные имена хостов, просто объявите URL правило с информацией о хосте, например:<br />
    <?php
    highlight_string("<?php
[
    'http://<user:\\w+>.example.com/<lang:\\w+>/profile' => 'user/profile',
]
?>");
    ?>
</p>
<p>
    В приведенном выше примере первый сегмент имени хоста рассматривается в качестве параметра пользователя, в то время как первый сегмент информации пути рассматривается в качестве параметра языки. Правило соответствует  маршруту user/profile.
</p>
<p>
    Обратите внимание, что [[yii\web\UrlManager::showScriptName]] не вступит в силу, если URL создается с помощью правила с параметризованным хостом.
</p>
<p>
    Также отметим, что любое правило с параметризованным хостом не должно содержать вложенную папку, если приложение находится во вложенной папке веб корня. Например, если приложение находится в http://www.example.com/sandbox/blog, то мы все равно должны использовать то же правило URL, как описано выше без подпапки sandbox/blog.
</p>
<h3>
    Подделка URL суффикса
</h3>
<?php
highlight_string("<?php
<?php
return [
    // ...
    'components' => [
        'urlManager' => [
            'suffix' => '.html',
        ],
    ],
];
?>");
?>
<h3>
    Обработка запросов REST
</h3>
<p>
    Подлежит обсуждению
</p>
<ul>
    <li>RESTful маршрутизация: [[yii\web\VerbFilter]], [[yii\web\UrlManager::$rules]]</li>
    <li>Json API:
        <ul>
            <li>response: [[yii\web\Response::format]]</li>
            <li>request: [[yii\web\Request::$parsers]], [[yii\web\JsonParser]]</li>
        </ul>
    </li>
</ul>
<h2>
    Разбор URL
</h2>
<hr />
<p>
    Бесплатный для создания URL-адресов Yii, также обрабатывает преобразования пользовательских URL-адресов обратно во внутренние маршруты и параметры.
</p>
<h3>
    Строгий разбор URL
</h3>
<p>
    По умолчанию, если нет пользовательских правил для URL и URL совпадает с форматом по умолчанию, например, /site/page, то Yii пытается запустить соответствующее действие контроллера. Такое поведение может быть отключено, если нет соответствующих пользовательских правил, тогда будет генерироваться исключение с кодом ошибки = 404.<br />
    <?php
    highlight_string("<?php
<?php
return [
    // ...
    'components' => [
        'urlManager' => [
            'enableStrictParsing' => true,
        ],
    ],
];
?>");
    ?>
</p>
<h2>
    Создание собственных классов для правил
</h2>
<hr />
<p>
    Класс [[yii\web\UrlRule]] используется для разбора URL в параметры и создания URL на основе параметров. Несмотря на то, что реализация по умолчанию является достаточно гибкой для большинства проектов, бывают ситуации, когда, использование собственного класса для правил является лучшим выбором. Например, в веб-сайте по продаже легковых автомобилей, мы хотим, чтобы поддерживался формат URL типа /Manufacturer/Model, где Manufacturer и Model должны оба соответствовать некоторым данным в таблице базы данных. Класс для правил по умолчанию не будет работать, потому что он в основном полагается на статически объявленные регулярные выражения, которые не имеют доступа к базе данных.
</p>
<p>
    Мы можем написать новый класс для правил URL, путем расширения от [[yii\web\UrlRule]] и использовать его в одном или нескольких правилах URL. Используя вышеупомянутый сайт Автосалон в качестве примера, мы можем объявить следующие правила URL в конфигурации приложения:<br />
    <?php
    highlight_string("<?php
// ...
'components' => [
    'urlManager' => [
        'rules' => [
            '<action:(login|logout|about)>' => 'site/<action>',

            // ...

            ['class' => 'app\\components\\CarUrlRule', 'connectionID' => 'db', /* ... */],
        ],
    ],
],
?>");
    ?>
</p>
<p>
    В приведенном выше коде, мы используем созданный класс для правил URL CarUrlRule, чтобы обрабатывать URL формат /Manufacturer/Model. Класс можно записать так:<br />
    <?php
    highlight_string("<?php
namespace app\\components;

use yii\\web\\UrlRule;

class CarUrlRule extends UrlRule
{
    public \$connectionID = 'db';

    public function createUrl(\$manager, \$route, \$params)
    {
        if (\$route === 'car/index') {
            if (isset(\$params['manufacturer'], \$params['model'])) {
                return \$params['manufacturer'] . '/' . \$params['model'];
            } elseif (isset(\$params['manufacturer'])) {
                return \$params['manufacturer'];
            }
        }
        return false;  // this rule does not apply
    }

    public function parseRequest(\$manager, \$request)
    {
        \$pathInfo = \$request->getPathInfo();
        if (preg_match('%^(\\w+)(/(\\w+))?$%', \$pathInfo, \$matches)) {
            // check \$matches[1] and \$matches[3] to see
            // if they match a manufacturer and a model in the database
            // If so, set \$params['manufacturer'] and/or \$params['model']
            // and return ['car/index', \$params]
        }
        return false;  // this rule does not apply
    }
}
?>");
    ?>
</p>
<p>
    Кроме вышеуказанного использования, пользовательские классы для правил URL, также могут быть реализованы для многих других целей. Например, мы можем написать класс правила для логирования синтаксического анализа URL и создания запросов. Это может быть полезно на стадии разработки. Мы также можем написать класс правила для отображения специальной страницы для 404 ошибки, если все другие правила URL не в состоянии решить текущий запрос. Отметим, что в этом случае правило этого специального класса должно быть объявлено как последнее правило.
</p>
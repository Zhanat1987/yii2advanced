<h1>
    Вид
</h1>
<hr />
<p>
    Компонент вид является важной частью MVC. Вид действует в качестве интерфейса приложения, что делает его ответственным за представление данных для конечных пользователей, отображения форм, и так далее.
</p>
<h2>
    Основы
</h2>
<hr />
<p>
    По умолчанию Yii использует PHP в представлениях для генерации содержимого и элементов. Вид веб-приложений, как правило, содержит некоторую комбинацию HTML, вместе с PHP: echo, foreach, if и другие основные конструкции. Использование сложного (комплексного) PHP кода в представлениях считается плохой практикой. Когда нужна сложная логика и функциональность, такой код должен быть перемещен в контроллер или виджет.
</p>
<p>
    Вид обычно вызывается из действия контроллера с помощью метода [[yii\base\Controller::render()|render()]]:<br />
    <?php
    highlight_string("<?php
public function actionIndex()
{
    return \$this->render('index', ['username' => 'samdark']);
}
?>");
    ?>
</p>
<p>
    Первый аргумент метода [[yii\base\Controller::render()|render()]] является именем представления, которое надо отобразить. В контексте контроллера, Yii будет искать свои представления в папке 'views/site/', где 'site' - ID контроллера. Для получения дополнительной информации о том, как будет выглядеть имя представления, обратитесь к  методу [[yii\base\Controller::render()]].
</p>
<p>
    Второй аргумент метода [[yii\base\Controller::render()|render()]] является ассоциативным массивом данных пар ключ-значение. С помощью этого массива, данные могут быть переданы в представления, в результате чего значение доступны в представлении в виде переменной с именем совпадающим с его соответствующим ключом.
</p>
<p>
    Вид для действия выше будет 'views/site/index.php' и может быть что-то вроде:<br />
    <?php
    highlight_string("<?php
<p>Hello, <?= \$username ?>!</p>
?>");
    ?>
</p>
<p>
    Любые типы данных могут быть переданы в представления, в том числе массивы или объекты.
</p>
<p>
    Кроме указанного выше метода [[yii\base\Controller::render()|render()]], класс [[yii\web\Controller]] также предоставляет несколько других методов отображения представлений. Ниже приводится краткая информация этих методов:
</p>
<ul>
    <li>[[yii\web\Controller::render()|render()]]: отображает представление и применяет макет в результате рендеринга. Это наиболее часто используемый метод, чтобы отобразить полную страницу.</li>
    <li>[[yii\web\Controller::renderPartial()|renderPartial()]]: отображает представление без применения макета. Это часто используется для отображения фрагмента страницы.</li>
    <li>[[yii\web\Controller::renderAjax()|renderAjax()]]: отображает представление без применения макета, и вводит все зарегистрированные JS/CSS скрипты и файлы. Это наиболее часто используется для отображения HTML вывода реагировать на AJAX запрос.</li>
    <li>[[yii\web\Controller::renderFile()|renderFile()]]: отображает представление файла. Это похоже на [[yii\web\Controller::renderPartial()|renderPartial()]], за исключением того, что он принимает путь к файлу представления вместо имени представления.</li>
</ul>
<h2>
    Виджеты
</h2>
<hr />
<p>
    Виджеты представляют собой автономные блоки для ваших представлений, таким образом, чтобы объединить сложную логику, отображение, и функциональность в одном компоненте. Виджет:
</p>
<ul>
    <li>Может содержать продвинутый PHP код</li>
    <li>Обычно есть возможность настройки</li>
    <li>Часто предоставляет данные, которые будут отображаться</li>
    <li>Возвращает HTML, который будет показан в контексте представления</li>
</ul>
<p>
    Есть большое количество виджетов в комплекте с Yii, такие как active form, breadcrumbs, menu, и обертки вокруг компонента bootstrap. Кроме того, существуют расширения, которые предоставляют дополнительные виджеты, такие как официальный виджет для компонентов jQueryUI.
</p>
<p>
    Для того чтобы использовать виджет в представление надо будет сделать следующее:<br />
    <?php
    highlight_string("<?php
// Обратите внимание, что вы должны вызвать 'echo' для его отображения
echo \\yii\\widgets\\Menu::widget(['items' => \$items]);

// Передача массива для инициализации свойств объекта
\$form = \\yii\\widgets\\ActiveForm::begin([
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => ['inputOptions' => ['class' => 'input-xlarge']],
]);
... form inputs here ...
\\yii\\widgets\\ActiveForm::end();
?>");
    ?>
</p>
<p>
    В первом примере в коде выше метод [[yii\base\Widget::widget()|widget()]] используется для вызова виджета, который просто выводит содержимое. Во втором примере, [[yii\base\Widget::begin()|begin()]] и [[yii\base\Widget::end()|end()]] используются для виджета, чтобы обернуть содержимое между вызовами методов и выводом содержимого. В случае с формой - это тег <?php highlight_string("<form>"); ?> и установка некоторых его атрибутов.
</p>
<h2 name="security">
    Безопасность
</h2>
<hr />
<p>
    Одним из основных принципов безопасности - это всегда экранировать (escape) вывод содержимого. Если это нарушено, то это приводит к выполнению скрипта (зловредного кода) и, скорее всего, это межсайтовый скриптинг, известный как XSS приводит к потере пароля администратора, что дает пользователю автоматически выполнять действия и т.д.
</p>
<p>
    Yii обеспечивает хороший набор инструментов для того, чтобы помочь вам экранировать ваш вывод. Основное, что надо сделать, чтобы экранировать вывод - это вывод текста без разметки. Вы можете справиться с ней так:<br />
    <?php
    highlight_string("<?php
<?php
use yii\helpers\Html;
?>
<div class=\"username\">
    <?= Html::encode(\$user->name) ?>
</div>
?>");
    ?>
</p>
<p>
    Если вы хотите вывести с HTML'ом это становится сложным, так что мы предоставляем для решения этой задачи прекрасную библиотеку HTMLPurifier, которая обернута в Yii как помощник [[yii\helpers\HtmlPurifier]]:<br />
    <?php
    highlight_string("<?php
<?php
use yii\helpers\HtmlPurifier;
?>
<div class=\"post\">
    <?= HtmlPurifier::process(\$post->text) ?>
</div>
?>");
    ?>
</p>
<p>
    Заметим, что HTMLPurifier помимо того, что делает отличную работу по безопасному выводу, не очень быстрый, поэтому надо рассмотреть кэширование результата.
</p>
<h2>
    Альтернативные языки шаблонов
</h2>
<hr />
<p>
    Есть официальные расширения для Smarty и Twig. Для того, чтобы узнать о них больше смотрите раздел использование движков для шаблонов в руководстве.
</p>
<h2>
    Использование объекта View в шаблонах
</h2>
<hr />
<p>
    Экземпляр компонента [[yii\web\View]] доступен в представлениях через переменную $this. С его помощью в шаблонах можно сделать много полезных вещей, включая настройки заголовков страницы и мета, регистрация скриптов и доступ к контексту.
</p>
<h3>
    Установка заголовка страницы
</h3>
<p>
    Общим местом для установки заголовка страницы является представление. Так мы можем получить доступ к объекту представления через переменную $this, установить заголовка становится так легко, как:<br />
    <?php
    highlight_string("<?php
\$this->title = 'My page title';
?>");
    ?>
</p>
<h3>
    Добавление мета-тегов
</h3>
<p>
    Добавление таких мета-тегов, как encoding, description, keywords очень легко в представлении через переменную $this:<br />
    <?php
    highlight_string("<?php
\$this->registerMetaTag(['encoding' => 'utf-8']);
?>");
    ?>
</p>
<p>
    Первый аргумент является ключом <meta> тега, а второй значением. Этот код будет производить:<br />
    <?php
    highlight_string("<?php
<meta encoding=\"utf-8\">
?>");
    ?>
</p>
<p>
    Иногда есть необходимость иметь только один тег типа. В этом случае вам нужно указать второй аргумент:<br />
    <?php
    highlight_string("<?php
\$this->registerMetaTag(['description' => 'This is my cool website made with Yii!'], 'meta-description');
\$this->registerMetaTag(['description' => 'This website is about funny raccoons.'], 'meta-description');
?>");
    ?>
</p>
<p>
    При наличии нескольких вызовов с одинаковым значением второго аргумента (в данном случае meta-description), последний заменит предыдущий и только один тег будет показан:<br />
    <?php
    highlight_string("<?php
<meta description=\"This website is about funny raccoons.\">
?>");
    ?>
</p>
<h3>
    Регистрация тега link
</h3>
<p>
    Тег <link> полезен во многих случаях, таких как настройка favicon, создания RSS ленты или делегирования OpenID на другой сервер. В Yii объект представления имеет метод для работы с этим:<br />
    <?php
    highlight_string("<?php
\$this->registerLinkTag([
    'title' => 'Lives News for Yii Framework',
    'rel' => 'alternate',
    'type' => 'application/rss+xml',
    'href' => 'http://www.yiiframework.com/rss.xml/',
]);
?>");
    ?>
</p>
<p>
    Код выше вернет следующий результат:<br />
    <?php
    highlight_string("<?php
<link title=\"Lives News for Yii Framework\" rel=\"alternate\" type=\"application/rss+xml\" href=\"http://www.yiiframework.com/rss.xml/\" />
?>");
    ?>
</p>
<p>
    Так же как и в случае с мета-тегами, вы можете указать второй параметр, чтобы быть уверенными, что зарегестрируется только один тег link.
</p>
<h3>
    Регистрация CSS
</h3>
<p>
    Вы можете зарегистрировать CSS, используя [[yii\web\View::registerCss()|registerCss()]] (блок кода css) или [[yii\web\View::registerCssFile()|registerCssFile()]] (внешний файл CSS). Например:<br />
    <?php
    highlight_string("<?php
\$this->registerCss(\"body { background: #f00; }\");
?>");
    ?>
</p>
<p>
    Код выше регистрирует следующий результат в секции head страницы:<br />
    <?php
    highlight_string("<?php
<style>
body { background: #f00; }
</style>
?>");
    ?>
</p>
<p>
    Если вы хотите указать дополнительные свойства тега style, передайте ассоциативный массив имен-значений для третьего аргумента. Если вам нужно, убедиться, что есть только один тег style, то передайте четвертый аргумент, как было упомянуто в meta-тегах.<br />
    <?php
    highlight_string("<?php
\$this->registerCssFile(\"http://example.com/css/themes/black-and-white.css\", [BootstrapAsset::className()], ['media' => 'print'], 'css-print-theme');
?>");
    ?>
</p>
<p>
    Код выше регистрирует тег link к файлу CSS в секции head страницы:
</p>
<ul>
    <li>Первый аргумент указывает файл CSS для регистрации.</li>
    <li>Второй аргумент указывает, что этот файл CSS зависит от [[yii\bootstrap\BootstrapAsset|BootstrapAsset]], то есть он будет добавлен после CSS файлов в [[yii\bootstrap\BootstrapAsset|BootstrapAsset]]. Без этой спецификации зависимости, относительный порядок между этим файлом CSS и  файлами CSS из [[yii\bootstrap\BootstrapAsset|BootstrapAsset]] не будут определены.</li>
    <li>Третий аргумент указывает атрибуты для результирующего тега <link>.</li>
    <li>Последний аргумент указывает, ID идентифицирующий этот файл CSS. Если это не предусмотрено, будет использоваться URL файла CSS как ID.</li>
</ul>
<p>
    Настоятельно рекомендуется использовать asset bundles (пучки активов) для регистрации внешних файлов CSS, а не с помощью [[yii\web\View::registerCssFile()|registerCssFile()]]. Использование asset bundles (связки активов) позволяет объединить и сжать несколько файлов CSS, что является желательным для сайтов с большим трафиком.
</p>
<h3>
    Регистрация скриптов
</h3>
<p>
    С помощью объекта [[yii\web\View]] можно зарегистрировать скрипты. Есть два выделенных метода для этого: [[yii\web\View::registerJs()|registerJs()]] для встроенных сценариев и [[yii\web\View::registerJsFile()|registerJsFile()]] для внешних скриптов. Встроенные скрипты полезны для конфигурирования и динамически сгенерированного кода. Пример использования метода для добавления встроенных сценариев:<br />
    <?php
    highlight_string("<?php
\$this->registerJs(\"var options = \".json_encode(\$options).\";\", View::POS_END, 'my-options');
?>");
    ?>
</p>
<p>
    Первый аргумент - это JS-код, который мы хотим внедрить в страницу. Второй аргумент определяет, где сценарий должен быть вставлен в страницу.
    Возможные значения:
</p>
<ul>
    <li>[[yii\web\View::POS_HEAD|View::POS_HEAD]] в разделе head.</li>
    <li>[[yii\web\View::POS_BEGIN|View::POS_BEGIN]] сразу после открытия тега <body>.</li>
    <li>[[yii\web\View::POS_END|View::POS_END]] прямо перед закрытием тега </body>.</li>
    <li>[[yii\web\View::POS_READY|View::POS_READY]] выполняет код, когда будет готово DOM-дерево страницы. Автоматически регистрирует [[yii\web\JqueryAsset|jQuery]].</li>
    <li>[[yii\web\View::POS_LOAD|View::POS_LOAD]] выполняет код, когда будет загружено DOM-дерево страницы. Автоматически регистрирует [[yii\web\JqueryAsset|jQuery]].</li>
</ul>
<p>
    Последний аргумент является уникальным ID сценария, который используется для идентификации блока кода и заменить существующий с тем же ID, а не добавлять новый. Если вы не предоставите его, сам код JS будет использоваться в качестве идентификатора.
</p>
<p>
    Внешний скрипт можно добавить так:<br />
    <?php
    highlight_string("<?php
\$this->registerJsFile('http://example.com/js/main.js', [JqueryAsset::className()]);
?>");
    ?>
</p>
<p>
    Аргументы [[yii\web\View::registerJsFile()|registerJsFile()]] аналогичны для [[yii\web\View::registerCssFile()|registerCssFile()]]. В приведенном выше примере, мы регистрируем main.js файл с зависимостью от JqueryAsset. Это означает, что файл main.js будет добавлен после jquery.js. Без этой спецификации зависимости, относительный порядок между main.js и jquery.js не будет определен.
</p>
<p>
    Как и для [[yii\web\View::registerCssFile()|registerCssFile()]] также настоятельно рекомендуем вам использовать asset bundles (связки активов) для регистрации  внешних файлов JS, а не использовать [[yii\web\View::registerJsFile()|registerJsFile()]].
</p>
<h3>
    Регистрация asset bundles (связки активов)
</h3>
<p>
    Как уже отмечалось ранее, это предпочтительно использовать asset bundles (связки активов) вместо использования CSS и JavaScript непосредственно. Вы можете получить подробную информацию о том, как определить asset bundles (связки активов) в разделе управление asset bundles (связки активов) руководства. Что касается использования уже определенных asset bundles (связки активов), это очень просто:<br />
    <?php
    highlight_string("<?php
\\frontend\\assets\\AppAsset::register(\$this);
?>");
    ?>
</p>
<h3>
    Макет
</h3>
<p>
    Макет представляет собой очень удобный способ, чтобы представить часть страницы, которая является общей для всех или, по крайней мере, для большинства страниц, генерируемых приложением. Как правило, она включает в себя раздел <head> и footer, главное меню и одинаковые элементы. Вы можете найти прекрасный пример макета в базовом шаблоне приложения. Здесь мы рассмотрим самые основы, без всех виджетов или дополнительной разметки.<br />
    <?php
    highlight_string("<?php
<?php
use yii\helpers\Html;
?>
<?php \$this->beginPage() ?>
<!DOCTYPE html>
<html lang=\"<?= Yii::\$app->language ?>\">
    <head>
        <meta charset=\"<?= Yii::\$app->charset ?>\"/>
        <title><?= Html::encode(\$this->title) ?></title>
        <?php \$this->head() ?>
    </head>
<body>
<?php \$this->beginBody() ?>
<div class=\"container\">
    <?= \$content ?>
</div>
<footer class=\"footer\">© 2013 me :)</footer>
<?php \$this->endBody() ?>
</body>
</html>
<?php \$this->endPage() ?>
?>");
    ?>
</p>
<p>
    В разметке выше есть некоторый код. Прежде всего, $content является переменной, которая будет содержать результат вывода прдеставления, возвращаемого методом $this->render() контроллера.
</p>
<p>
    Мы импортируем помощника [[yii\helpers\Html|Html]] через стандартное подключение соответствующего пространства имени. Этот помощник обычно используется для почти всех прдеставлений, где нужно экранировать выводимые данные.
</p>
<p>
    Несколько специальных методов, таких как [[yii\web\View::beginPage()|beginPage()]]/[[yii\web\View::endPage()|endPage()]], [[yii\web\View::head()|head()]], [[yii\web\View::beginBody()|beginBody()]]/[[yii\web\View::endBody()|endBody()]] нужны для отображения представления, также используются для регистрации скриптов, ссылок и во многих других процессах страницы. Всегда включайте их в макете для того, чтобы отображение правильно работало.
</p>
<h3>
    Частичное представление
</h3>
<p>
    Часто возникает необходимость повторно использовать какую-то HTML разметку во многих представлениях и часто это слишком просто, чтобы создавать для этого полнофункциональный виджет. В этом случае вы можете использовать частичные представления.
</p>
<p>
    Также представляет собой вид. Он находится в одном из каталогов в views и по соглашению его имя начинается с символа '_'. Например, мы должны показывать список пользовательских профилей и, в то же время, отображать индивидуальный профиль в другом месте.
</p>
<p>
    Сначала мы должны определить частичное представление для профиля пользователя в _profile.php:<br />
    <?php
    highlight_string("<?php
<?php
use yii\helpers\Html;
?>
<div class=\"profile\">
    <h2><?= Html::encode(\$username) ?></h2>
    <p><?= Html::encode(\$tagline) ?></p>
</div>
?>");
    ?>
</p>
<p>
    Тогда мы используем его в index.php представлении, где мы отображения список пользователей:<br />
    <?php
    highlight_string("<?php
<div class=\"user-index\">
    <?php
    foreach (\$users as \$user) {
        echo \$this->render('_profile', [
            'username' => \$user->name,
            'tagline' => \$user->tagline,
        ]);
    }
    ?>
</div>
?>");
    ?>
</p>
<p>
    Точно так же мы можем использовать его в другом представлении, где отображается один профиль пользователя:<br />
    <?php
    highlight_string("<?php
echo \$this->render('_profile', [
    'username' => \$user->name,
    'tagline' => \$user->tagline,
]);
?>");
    ?>
</p>
<h3>
    Доступ к контексту
</h3>
<p>
    Представления обычно используются в контроллерах или виджетах. В обоих случаях объект, который называется 'view rendering' доступен в представлении как $this->context. Например, если нам нужно вывести текущий внутренний маршрут запроса в представлении через контроллер, надо сделать следующее:<br />
    <?php
    highlight_string("<?php
echo \$this->context->getRoute();
?>");
    ?>
</p>
<h3>
    Кэширование блоков
</h3>
<p>
    Чтобы узнать о кэшировании фрагментов представления пожалуйста, обратитесь к разделу кэширования в руководстве.
</p>
<h2>
    Настройка компонента View
</h2>
<hr />
<p>
    Так как вид также является компонентом приложения по имени вид вы можете заменить его своим собственным компонентом, наследовавшись от [yii\base\View]] или [[yii\web\View]]. Это можно сделать с помощью файла конфигурации приложений, например, config/web.php:<br />
    <?php
    highlight_string("<?php
return [
    // ...
    'components' => [
        'view' => [
            'class' => 'app\\components\\View',
        ],
        // ...
    ],
];
?>");
    ?>
</p>
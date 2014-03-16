<h1>
    Панель инструментов отладка и отладчик
</h1>
<hr />
<p>
    Yii2 включает в себя удобную панель инструментов, чтобы помочь сделать быстрее разработку и отладку, а также отладчик. Панель инструментов отображает информацию о текущей открытой странице, используя отладчик можно анализировать данные, собранные ранее.
</p>
<p>
    Из коробки он позволяет:
</p>
<ul>
    <li>Возможность быстро получать версию фреймворка, PHP версию, статус ответа, текущий контроллер и действие, информацию о производительности и т.д. с помощью панели инструментов.</li>
    <li>Просмотр приложения и конфигурации PHP.</li>
    <li>Просмотр данных запроса, заголовков запросов и ответов, сессионные данные и переменные окружения.</li>
    <li>Просмотр, поиск, фильтрация журналов логирования.</li>
    <li>Просмотр результаты профилирования.</li>
    <li>Просмотреть запросы к базе данных.</li>
    <li>Просмотреть отправленные письма.</li>
</ul>
<p>
    Все они доступны для каждого запроса, также вы можете просматривать прошлые запросы.
</p>
<h2>
    Установка и настройка
</h2>
<hr />
<p>
    Добавьте эти строки в файл конфигурации:<br />
    <?php
    highlight_string("<?php
'preload' => ['debug'],
'modules' => [
    'debug' => ['yii\\debug\\Module']
]
?>");
    ?>
</p>
<blockquote>
    <p>
        Примечание: по умолчанию модуль отладки работает только при просмотре веб-сайта локально. Если вы хотите использовать его на удаленном (промежуточный) сервере, добавьте в параметр allowedIPs в конфигурации в белый список свой ​​IP, например : **
    </p>
</blockquote>
<?php
highlight_string("<?php
'preload' => ['debug'],
'modules' => [
    'debug' => [
        'class' => 'yii\\debug\\Module',
        'allowedIPs' => ['1.2.3.4', '127.0.0.1', '::1']
    ]
]
?>");
?>
<p>
    Если вы используете опцию enableStrictParsing в URL manager'е, то надо добавить следующее правило в ваши rules:<br />
    <?php
    highlight_string("<?php
'urlManager' => [
    'enableStrictParsing' => true,
    'rules' => [
        // ...
        'debug/<controller>/<action>' => 'debug/<controller>/<action>',
    ],
],
?>");
    ?>
</p>
<h3>
    Экстра конфигурация для логирования и профилирования
</h3>
<p>
    Логирование и профилирование очень простые, но очень мощные инструменты, которые могут помочь вам понять ход выполнения фреймворка и приложения. Они полезны при разработке и на продакшене.
</p>
<p>
    В то время как на продакшене вы должны логировать только достаточно важные сообщения вручную, как описано в разделе логирования, то при разработке бывает очень полезно получить трассировку выполнения.
</p>
<p>
    Для того чтобы получить сообщения трассировки, которые помогут вам понять, что происходит под капотом фреймворка, вам необходимо установить уровень трассировки в конфигурации:<br />
    <?php
    highlight_string("<?php
return [
    // ...
    'components' => [
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0, // <-- here
?>");
    ?>
</p>
<p>
    По умолчанию он автоматически устанавливается равным 3, если Yii запускается в режиме отладки, т.е. ваш index.php файл содержит следующее:<br />
    <?php
    highlight_string("<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
?>");
    ?>
</p>
<blockquote>
    <p>
        Примечание: Убедитесь, что отключен режим отладки, так как это может оказать существенное влияние на производительность и показать скрытую информацию о коде для конечных пользователей.
    </p>
</blockquote>
<h2>
    Создание собственных панелей
</h2>
<hr />
<p>
    Панель инструментов и отладчик легко конфигурируются и настраиваются. Вы можете создавать свои собственные панели, которые могут собирать и отображать дополнительные данные. Ниже мы опишем процесс создания простой пользовательской панели, которая собирает представления, исполняемые во время запроса, показывает число на панели инструментов и позволяет проверять имена представлений в отладчике. Ниже мы предполагаем, что используется basic (основной) шаблон приложения.
</p>
<p>
    Сначала мы должны реализовать класс панели в panels/ViewsPanel.php:<br />
    <?php
    highlight_string("<?php
namespace app\\panels;

use yii\\base\\Event;
use yii\\base\\View;
use yii\\base\\ViewEvent;
use yii\\debug\\Panel;


class ViewsPanel extends Panel
{
    private \$_viewFiles = [];

    public function init()
    {
        parent::init();
        Event::on(View::className(), View::EVENT_BEFORE_RENDER, function (ViewEvent \$event) {
            \$this->_viewFiles[] = \$event->sender->getViewFile();
        });
    }


    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'Views';
    }

    /**
     * @inheritdoc
     */
    public function getSummary()
    {
        \$url = \$this->getUrl();
        \$count = count(\$this->data);
        return \"<div class=\\\"yii-debug-toolbar-block\\\"><a href=\\\"\$url\\\">Views <span class=\\\"label\\\">
        \$count</span></a></div>\";
    }

    /**
     * @inheritdoc
     */
    public function getDetail()
    {
        return '<ol><li>' . implode('<li>', \$this->data) . '</ol>';
    }

    /**
     * @inheritdoc
     */
    public function save()
    {
        return \$this->_viewFiles;
    }
}
?>");
    ?>
</p>
<p>
    Рабочий процесс для приведенного выше кода заключается в следующем:
</p>
<ol>
    <li>init (инициализация) выполняется перед запуском любого действия контроллера. Лучшее место для присоединения обработчиков, которые будут собирать данные.</li>
    <li>save (сохранить) вызывается после выполнения действия контроллера. Возвращаемые данные хранятся в файлах данных. Если ничего не вернулось, то панель не покажется.</li>
    <li>Данные из файлов данных загружаются в $this->data. Для панели инструментов это всегда самые последние данные, для отладчика для чтения может быть выбран любой предыдущий файл данных.</li>
    <li>Панель инструментов берет свое содержимое из getSummary. Там мы показываем количество отработанных представлений. Для той же цели отладчик использует getDetail.</li>
</ol>
<p>
    Теперь пришло время рассказать отладчику как использовать нашу новую панель. В файле config/web.php надо настроить debug:<br />
    <?php
    highlight_string("<?php
if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    \$config['preload'][] = 'debug';
    \$config['modules']['debug'] = [
        'class' => 'yii\\debug\\Module',
        'panels' => [
            'views' => ['class' => 'app\\panels\\ViewsPanel'],
        ],
    ];

// ...
?>");
    ?>
</p>
<p>
    Вот и все. Теперь у нас есть еще одна полезная панель без написания большого количества кода.
</p>
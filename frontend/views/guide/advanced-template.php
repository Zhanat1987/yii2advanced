<h1>
    Расширенный шаблон приложения
</h1>
<hr />
<p>
    Этот шаблон предназначен для крупных проектов, разрабатываемых группой разрабочиков,
    где бэк-енд отделен от фронт-енда, приложение развертывается на нескольких серверах и т.д.
    Этот шаблон приложения также идет немного дальше относительно особенностей и обеспечивает необходимую базу данных,
    регистрацию и восстановление пароля из коробки.
</p>
<h2>
    Установка
</h2>
<hr />
<h3>
    Установка с помощью Composer
</h3>
<pre>
    cd C:\xampp\htdocs
    php C:\ProgramData\Composer\bin\composer.phar self-update
    php C:\ProgramData\Composer\bin\composer.phar create-project --prefer-dist --stability=dev yiisoft/yii2-app-advanced yii2.translate
    cd yii2.translate
    php init
    создать бд
    настроить конфиг бд в common/config/main-local.php
    // накатить миграцию, которая создаст таблицу для пользователей
    yii migrate
    перейти в site/signup и зарегестрировать там пользователя - administrator/administrator admin@admin.com
    закинуть .htaccess в '/frontend/web/' и '/backend/web/'
</pre>
<h2>
    Структура директорий
</h2>
<hr />
<pre>
    Корневой каталог содержит следующие подкаталоги:
        backend - бэк-енд приложения
        frontend - front-енд приложения
        common - файлы, общие для всех приложений
        environments - конфиги среды (окружения) приложения
        console - консоль приложения
    Корневой каталог содержит набор файлов:
        .gitignore - содержит список каталогов, игнорируемых git'ом.
        Если надо исключить что-то из исходного кода репозитория, то можно можно указать их в этом файле.
        composer.json - конфигурационный файл Composer'а, подробно описан ниже
        init - скрипт начальной инициализации шаблона.
        init.bat - скрипт начальной инициализации шаблона для Windows.
        LICENSE.md - Информация о лицензии. Опишите вашу лицензию проекта в этом файле. Особенно если это opensourcing (открытый) проект.
        README.md - Основная информация об установке шаблона. Подумайте о том, чтобы изменить его
            в соответствии для установки и общей информации о Вашем проекте.
        requirements.php - скрипт проверки требований окружения для Yii 2 фреймворка.
        yii - файл загрузки консольного приложения.
        yii.bat - файл загрузки консольного приложения для Windows.
</pre>
<h2>
    Приложения
</h2>
<hr />
<p>
    В расширенном шаблоне есть 3 приложения: frontend, backend и console.<br />
    Frontend, как правило, то, что представлено для конечного пользователя, сам проект.<br />
    Backend - это админ-я часть приложения, отчеты, и т.д.<br />
    Console - обычно используется для задач по cron'у, фоновых(асинхронных) задач, очередей и т.д.
    Также он используется во время развертывания приложений и обрабатывает миграции и assets'ы.<br />
    Там также есть common каталог, содержащий файлы, общие для всех приложений. Например, модель 'User'.<br />
    И фронт-енд, и бэк-енд являются веб-приложениями и содержат директорию 'web', которая является корневой директорией
    приложения и ее надо указать веб-серверу.<br />
    Каждое приложение имеет свое собственное пространство имен и псевдонимы, соответствующие его имени.<br />
    То же самое относится и к common директории.
</p>
<h2>
    Конфигурация и среда
</h2>
<hr />
<p>
    Есть несколько проблем с простым подходом к конфигурации:<br />
    Каждый участник команды имеет свои параметры конфигурации. Коммит таких настроек может повлиять на других участников команды.<br />
    Продакшен пароль базы данных и API ключи не должны оказаться в хранилище.<br />
    Есть несколько серверов: разработка, тестирование, продакшен. Каждый должен иметь свою собственную конфигурацию.<br />
    Определение всех параметров конфигурации для каждого случая является очень избыточным и занимает слишком много времени, чтобы сохранить.<br />
    Для того, чтобы решить эти вопросы Yii вводит понятие сред, которое является очень простым. Каждая среда представлена ​​набором файлов в директории environments.<br />
    Команда 'init' - используется для переключения между ними.<br />
    Что делает команда 'init' - это просто копирование всего содержимого из каталога environment(окружающей среды) в корневой каталог, где все приложения.<br />
    Обычно среда содержит файлы начальной загрузки приложения - index.php и конфигурационные файлы с суффиксом - '-local.php'.<br />
    Они прописываются в '.gitignore' и никогда не загружаются в репозиторий.<br />
    Во избежание дублирования, конфигурационные файлы имеют преимущество друг перед другом.<br />
    Например, фронт-енд считывает конфигурацию в следующем порядке:<br />
    common/config/main.php<br />
    common/config/main-local.php<br />
    frontend/config/main.php<br />
    frontend/config/main-local.php<br />
    Параметры считываются в следующем порядке:<br />
    common/config/params.php<br />
    common/config/params-local.php<br />
    frontend/config/params.php<br />
    frontend/config/params-local.php<br />
    Последний файл переписывает настройки или параметры предыдущего файла.<br />
    Вот полная схема:<br />
    <img style="max-width:100%;" alt="Advanced application configs" src="https://github.com/yiisoft/yii2/raw/master/docs/guide/images/advanced-app-configs.png">
</p>
<h2>
    Настройка Composer'а
</h2>
<hr />
<p>
    После окончания установки шаблона приложения, хорошей идеей считается - настройка файла composer.json, который можно найти в корневом каталоге:<br />
    Вначале мы обновляем основную информацию. Изменяем name, description, keywords, homepage и support в соответствии с проектом.<br />
    Теперь самое интересное. Вы можете добавить дополнительные пакеты в приложение в секцию require. Все эти пакеты должны быть опубликованы на сайте <a href="http://packagist.org" target="_blank">packagist.org</a>, так что не стесняйтесь и просмотрите этот веб-сайт для поиска полезного кода.<br />
    После того как был изменен composer.json вы можете запустить 'php composer.phar update --prefer-dist', подождать пока все необходимые пакеты скачаются и установятся, а затем просто использовать их.<br />
    Автозагрузка классов при этом будет обрабатываться автоматически.
</p>
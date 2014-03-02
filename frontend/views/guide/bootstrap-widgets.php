<h1>
    Виджеты Bootstrap
</h1>
<hr />
<p>
    Yii из коробки включает в себя поддержку разметки и компонентов фреймворка с использованием Bootstrap 3 (также известный как "Twitter Bootstrap"). Bootstrap является отличным фреймворком для верстки, что может значительно ускорить ваш процесс разработки на стороне клиента.
</p>
<p>
    Ядро Bootstrap представлено в двух частях
</p>
<ul>
    <li>Основы CSS, такие как grid (система макета сетки), typography (типография), helper'ы (вспомогательные классы) и responsive утилиты.</li>
    <li>Готовые к использованию компоненты - меню, нумерация страниц, модальные окна, вкладки и т.д.</li>
</ul>
<h2>
    Основы
</h2>
<hr />
<p>
    Yii не оборачивает bootstrap код в PHP код с HTML, так как он прост сам по себе. Вы можете найти подробные сведения об использовании основ bootstrap по ссылке <a href="http://getbootstrap.com/css/" target="_blank">документация bootstrap</a>. Тем не менее Yii обеспечивает удобный способ подключить bootstrap на ваших страницах, это делается добавлением одной строки в AppAsset.php, расположенного в папке config:<br />
    <?php
    highlight_string("<?php
public \$depends = [
    'yii\\web\\YiiAsset',
    'yii\\bootstrap\\BootstrapAsset', // this line
    // 'yii\\bootstrap\\BootstrapThemeAsset' // uncomment to apply bootstrap 2 style to bootstrap 3
];
?>");
    ?>
</p>
<p>
    Использование bootstrap через Yii asset manager позволяет свести к минимуму bootstrap ресурсы и объединить с вашими собственными ресурсами при необходимости.
</p>
<h2>
    Виджеты Yii
</h2>
<hr />
<p>
    Большинство сложных компонентов bootstrap'а обернуты в виджеты Yii, чтобы позволить более надежный синтаксис и интеграцию с возможностями фреймворка. Все виджеты принадлежат пространству имен \yii\bootstrap:
</p>
<ul>
    <li>[[yii\bootstrap\Alert|Alert]]</li>
    <li>[[yii\bootstrap\Button|Button]]</li>
    <li>[[yii\bootstrap\ButtonDropdown|ButtonDropdown]]</li>
    <li>[[yii\bootstrap\ButtonGroup|ButtonGroup]]</li>
    <li>[[yii\bootstrap\Carousel|Carousel]]</li>
    <li>[[yii\bootstrap\Collapse|Collapse]]</li>
    <li>[[yii\bootstrap\Dropdown|Dropdown]]</li>
    <li>[[yii\bootstrap\Modal|Modal]]</li>
    <li>[[yii\bootstrap\Nav|Nav]]</li>
    <li>[[yii\bootstrap\NavBar|NavBar]]</li>
    <li>[[yii\bootstrap\Progress|Progress]]</li>
    <li>[[yii\bootstrap\Tabs|Tabs]]</li>
</ul>
<h2>
    Использование .less файлов напрямую в Bootstrap
</h2>
<hr />
<p>
    Если вы хотите включить Bootstrap CSS прямо в ваши less файлы, вам может понадобиться отключить оригинальные Bootstrap CSS файлы, которые будут загружены. Вы можете сделать это, установив CSS свойство в [[yii\bootstrap\BootstrapAsset|BootstrapAsset]] пустым. Для этого вам нужно настроить компонент приложения assetManagner следующим образом:<br />
    <?php
    highlight_string("<?php
'assetManager' => [
        'bundles' => [
            'yii\\bootstrap\\BootstrapAsset' => [
                'css' => [],
            ]
        ]
    ]
?>");
    ?>
</p>
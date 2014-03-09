<h1>
    Data grid (сетка данных)
</h1>
<hr />
<p>
    Сетка данных или GridView является одним из самых мощных виджетов Yii. Это очень полезно, если вам нужно быстро создать администраторскую часть системы. Он принимает данные от data provider (поставщика данных) и показывает каждую строку, используя набор столбцов, представляющих данные в виде таблицы.
</p>
<p>
    Каждая строка таблицы представляет данные одного элемента данных, и колонка обычно представляет атрибут элемента (некоторые столбцы могут соответствовать комплексному выражению атрибутов или статическому тексту).
</p>
<p>
    Вид в виде таблицы поддерживает сортировку и разбиение на страницы элементов данных. Сортировка и разбиение на страницы можно сделать в режиме AJAX или нормальным запросом страницы. Преимуществом использования GridView является то, что когда пользователь отключает JavaScript, то сортировка и разбиение на страницы автоматически переходит к нормальным запросам страниц и работает так же как и ожидалось.
</p>
<p>
    Минимальный код необходимый для использования CGridView выглядит следующим образом:<br />
    <?php
    highlight_string("<?php
use yii\\data\\GridView;
use yii\\data\\ActiveDataProvider;

\$dataProvider = new ActiveDataProvider([
    'query' => Post::find(),
    'pagination' => [
        'pageSize' => 20,
    ],
]);
echo GridView::widget([
    'dataProvider' => \$dataProvider,
]);
?>");
    ?>
</p>
<p>
    Приведенный выше код сначала создает data provider (поставщика данных), а затем использует GridView для отображения каждого атрибута в каждой строке, взятой из data provider (поставщика данных). Отображаемая таблица оснащена сортировкой и нумерацией страниц.
</p>
<h2>
    Столбцы сетки
</h2>
<hr />
<p>
    Yii сетка состоит из ряда колонок. В зависимости от типа столбца и настроек они могут представить данные по-разному.
</p>
<p>
    Они определены в части колонок GridView в конфигурации вроде следующего:<br />
    <?php
    highlight_string("<?php
echo GridView::widget([
    'dataProvider' => \$dataProvider,
    'columns' => [
        ['class' => 'yii\\grid\\SerialColumn'],
        // A simple column defined by the data contained in \$dataProvider.
        // Data from model's column1 will be used.
        'id',
        'username',
        // More complex one.
        [
            'class' => 'DataColumn', // can be omitted, default
            'name' => 'column1',
            'value' => function (\$data) {
                return \$data->name;
            },
            'type'=>'raw',
        ],
    ],
]);
?>");
    ?>
</p>
<p>
    Заметим, что если ключ 'columns' в конфигурации не задан, то Yii пытается показать все возможные столбцы модели data provider (поставщик данных).
</p>
<h3>
    Классы столбцов
</h3>
<p>
    Столбцы сетки можно настроить с помощью различных классов столбцов:<br />
    <?php
    highlight_string("<?php
echo GridView::widget([
    'dataProvider' => \$dataProvider,
    'columns' => [
        [
            'class' => 'yii\\grid\\SerialColumn', // <-- here
            // you may configure additional properties here
        ],
?>");
    ?>
</p>
<p>
    Кроме классов столбцов определенных в Yii, мы рассмотрим ниже как можно создавать свои собственные классы столбцов.
</p>
<p>
    Каждый класс колонки расширяется от [[\yii\grid\Column]], так что некоторые распространенные опции, которые можно установить при настройке столбцов сетки.
</p>
<ul>
    <li>header - позволяет устанавливать контент для строки заголовка.</li>
    <li>footer - позволяет устанавливать контент для нижнего колонтитула.</li>
    <li>visible - это столбец должен быть виден.</li>
    <li>content - позволяет передавать валидный PHP callback, который будет возвращать данные для строки. Формат состоит в следующем:</li>
</ul>
<?php
highlight_string("<?php
function (\$model, \$key, \$index, \$grid) {
    return 'a string';
}
?>");
?>
<p>
    Вы можете задать различные параметры для контейнера HTML, передавая массивы со значениями в:
</p>
<ul>
    <li>headerOptions</li>
    <li>contentOptions</li>
    <li>footerOptions</li>
    <li>filterOptions</li>
</ul>
<h3>
    Data column (столбец данных)
</h3>
<p>
    Столбец данных для отображения и сортировки данных. Это тип столбца по умолчанию, так что указание класса может быть пропущено при его использовании.
</p>
<p>
    Подлежит обсуждению
</p>
<h3>
    Action column (столбец действия)
</h3>
<p>
    Колонка Действие отображает кнопки действий, такие как обновление или удаление для каждой строки.
</p>
<?php
highlight_string("<?php
echo GridView::widget([
    'dataProvider' => \$dataProvider,
    'columns' => [
        [
            'class' => 'yii\\grid\\ActionColumn',
            // you may configure additional properties here
        ],
?>");
?>
<p>
    Доступные свойства можно настроить следующим образом:
</p>
<ul>
    <li>controller - является идентификатором контроллера, который должен обрабатывать действие. Если не установлен, то он будет использовать активный в данный момент контроллер.</li>
    <li>template - это шаблон, используемый для составления каждой ячейку в столбец действия. Tokens, заключенные в фигурные скобки, рассматриваются как идентификаторы действий контроллера (также называемые имена кнопок в контексте колонки действия). Они будут заменены соответствующими callbacks кнопками указанными в [[buttons]]. Например, token {view} будет заменен на результат кнопок обратного вызова [«view»]. Если обратный вызов не может быть найден, token будет заменен пустой строкой. По умолчанию {view} {update} {delete}.</li>
    <li>buttons - является массивом кнопок обратных вызовов рендеринга. Ключами массива являются имена кнопок (без фигурных скобок), а значениями являются соответствующие кнопки обратных вызовов рендеринга. Обратные вызовы
должны использовать следующую сигнатуру:</li>
</ul>
<?php
highlight_string("<?php
function (\$url, \$model) {
    // return the button HTML code
}
?>");
?>
<p>
    В приведенном выше коде $url - это URL, который столбец создает для кнопки, и $model является объектом модели, передаваемой для текущей строки.
</p>
<ul>
    <li>urlCreator - является функцией обратного вызова, которая создает URL кнопку с использованием указанных сведений модели. Сигнатура обратного вызова должна быть такой же, как у [[createUrl()]]. Если это свойство не установлено, то кнопка URL-адреса будет создаваться с использованием [[createUrl()]].</li>
</ul>
<h3>
    Checkbox column (checkbox столбец)
</h3>
<p>
    CheckboxColumn показывает колонку с чекбоксами.
</p>
<p>
    Чтобы добавить CheckboxColumn в [[GridView]], добавьте его в [[GridView::columns|columns]] конфигурацию следующим образом:<br />
    <?php
    highlight_string("<?php
echo GridView::widget([
    'dataProvider' => \$dataProvider,
    'columns' => [
        // ...
        [
            'class' => 'yii\\grid\\CheckboxColumn',
            // you may configure additional properties here
        ],
    ],
?>");
    ?>
</p>
<p>
    Пользователи могут нажать на флажки для выбора строк сетки. Выбранные строки можно получить, вызвав следующий JavaScript код:<br />
    <?php
    highlight_string("<?php
var keys = $('#grid').yiiGridView('getSelectedRows');
// keys is an array consisting of the keys associated with the selected rows
?>");
    ?>
</p>
<h3>
    Серийный столбец
</h3>
<p>
    Серийный столбец обрабатывает номера строк, начиная с 1 и идет вперед.
</p>
<p>
    Использовать очень просто:<br />
    <?php
    highlight_string("<?php
echo GridView::widget([
    'dataProvider' => \$dataProvider,
    'columns' => [
        ['class' => 'yii\\grid\\SerialColumn'], // <-- here
?>");
    ?>
</p>
<p>
    TODO: переписать следующее:
</p>
<ul>
    <li>
        <a
            href="https://github.com/samdark/a-guide-to-yii-grids-lists-and-data-providers/blob/master/grid-columns.md"
            target="_blank">
            https://github.com/samdark/a-guide-to-yii-grids-lists-and-data-providers/blob/master/grid-columns.md
        </a>
    </li>
    <li>
        <a href="https://github.com/samdark/a-guide-to-yii-grids-lists-and-data-providers/pull/1"
           target="_blank">
            https://github.com/samdark/a-guide-to-yii-grids-lists-and-data-providers/pull/1
        </a>
    </li>
</ul>
<h2>
    Сортировка данных
</h2>
<hr />
<ul>
    <li>
        <a href="https://github.com/yiisoft/yii2/issues/1576" target="_blank">
            https://github.com/yiisoft/yii2/issues/1576
        </a>
    </li>
</ul>
<h2>
    Фильтрация данных
</h2>
<hr />
<ul>
    <li>
        <a href="https://github.com/yiisoft/yii2/issues/1581" target="_blank">
            https://github.com/yiisoft/yii2/issues/1581
        </a>
    </li>
</ul>
<h1>
    Обновление с Yii 1.1
</h1>
<hr />
<p>
    В этой главе мы перечислим основные изменения, внесенные в Yii 2.0, начиная с версии 1.1. Мы надеемся, этот список будет полезен для вас, чтобы обновиться с Yii 1.1 и быстро освоить Yii 2.0 на основе существующих Yii знаний.
</p>
<h2>
    Пространство имен
</h2>
<hr />
<p>
    Самое очевидное изменение в Yii 2.0 - это использование пространства имен. Почти каждый основной класс находится в пространстве имен, например, yii\web\Request. "С" префикс больше не используется в именах классов. Именование пространств имен в соответствии со структурой каталогов. Например, yii\web\Request указывает на соответствующий файл класса web/Request.php в папке фреймворка. Вы можете использовать любой основной класс без явного подключения этого файла класса, благодаря загрузчику классов Yii.
</p>
<h2>
    Компонент и Объект
</h2>
<hr />
<p>
    Yii 2.0 разделяет класс CComponent в 1.1 на два класса: [[yii\base\Object]] и [[yii\base\Component]]. Класс [[yii\base\Object|Object]] представляет собой легкий базовый класс, который позволяет определить свойства класса через getters и setters. Класс [[yii\base\Component|Component]] расширяется от [[yii\base\Object|Object]] и поддерживает события и поведения.
</p>
<p>
    Если ваш класс не нуждается в событиях или поведениях, то вы должны рассмотреть возможность использования объекта в качестве базового класса. Как правило, это относится к классам, которые представляют основные структуры данных.
</p>
<p>
    Подробнее об объекте и компоненте можно найти в разделе базовые концепции.
</p>
<h2>
    Конфигурация объекта
</h2>
<hr />
<p>
    Класс [[yii\base\Object|Object]] вводит единый способ конфигурирования объектов. Любой потомок класса [[yii\base\Object|Object]] должен объявить его конструктор (при необходимости) следующим образом, чтобы он мог быть правильно настроен:<br />
    <?php
    highlight_string("<?php
class MyClass extends \\yii\\base\\Object
{
    public function __construct(\$param1, \$param2, \$config = [])
    {
        // ... initialization before configuration is applied

        parent::__construct(\$config);
    }

    public function init()
    {
        parent::init();

        // ... initialization after configuration is applied
    }
}
?>");
    ?>
</p>
<p>
    В приведенном выше коде, последний параметр конструктора должен взять конфигурационный массив, который содержит пары имя-значение для инициализации свойства в конце конструктора. Вы можете переопределить метод [[yii\base\Object::init()|init()]], сделав работу по инициализации, которая должна быть сделана после применения конфигурации.
</p>
<p>
    Следуя этой конвенции, вы сможете создать и настроить новый объект, использующий массив конфигурации вроде следующего:<br />
    <?php
    highlight_string("<?php
\$object = Yii::createObject([
    'class' => 'MyClass',
    'property1' => 'abc',
    'property2' => 'cde',
], \$param1, \$param2);
?>");
    ?>
</p>
<p>
    Подробнее о конфигурации можно найти в разделе базовые концепции.
</p
<h2>
    События
</h2>
<hr />
<p>
    Уже не существует необходимости определения on-метода для определения события в Yii 2.0. Вместо этого, вы можете использовать любые имена событий. Чтобы присоединить обработчик к событию, теперь вы должны использовать on метод:<br />
    <?php
    highlight_string("<?php
\$component->on(\$eventName, \$handler);
// To detach the handler, use:
// \$component->off(\$eventName, \$handler);
?>");
    ?>
</p>
<p>
    При подключении обработчика, теперь вы можете связать его с некоторыми параметрами, которые могут быть позже доступны через параметры события от обработчика:<br />
    <?php
    highlight_string("<?php
\$component->on(\$eventName, \$handler, \$params);
?>");
    ?>
</p>
<p>
    Из-за этого изменения, теперь вы можете использовать "глобальные" события. Просто вызвать и присоединить обработчики к событию экземпляра приложения:<br />
    <?php
    highlight_string("<?php
Yii::\$app->on(\$eventName, \$handler);
....
// this will trigger the event and cause \$handler to be invoked.
Yii::\$app->trigger(\$eventName);
?>");
    ?>
</p>
<p>
    Если вам нужно обработать все экземпляры класса вместо объекта, то вы можете прикрепить обработчик вроде следующего:<br />
    <?php
    highlight_string("<?php
Event::on(ActiveRecord::className(), ActiveRecord::EVENT_AFTER_INSERT, function (\$event) {
    Yii::trace(get_class(\$event->sender) . ' is inserted.');
});
?>");
    ?>
</p>
<p>
    Этот код определяет обработчик, который сработает для каждого объекта Active Record при событии EVENT_AFTER_INSERT.
</p>
<p>
    Смотрите раздел обработка событий для более подробной информации.
</p>
<h2>
    Псевдоним пути
</h2>
<hr />
<p>
    Yii 2.0 расширяет использование псевдонимов путей для файлов/директорий и url-адресов. Псевдоним должен начинаться с символа @, чтобы его можно было отличить от файлов/директорий и url-адресов. Например, псевдоним @yii относится к каталогу установки Yii. Псевдонимов путей поддерживаются в большинстве мест в коде ядра Yii. Например, FileCache::cachePath может принимать как псевдоним пути, так и нормальный путь к каталогу.
</p>
<p>
    Псевдонимы путей также тесно связаны с пространствами имен класса. Рекомендуется, чтобы псевдоним пути был определен для каждого корневого пространства имен, так что вы можете использовать Yii класс автозагрузчика без дальнейшей конфигурации. Например, т.к. @yii относится к каталогу установки Yii, то такой класс как yii\web\Request может автоматически загружаться с помощью Yii. Если вы используете постороннюю библиотеку, например Zend Framework, то вы можете определить псевдоним пути @Zend, который относится к своей папке и Yii сможет сделать автозагрузку любого класса в этой библиотеке.
</p>
<p>
    Больше информации о псевдонимах пути можно найти в разделе базовые концепции.
</p>
<h2>
    Представление
</h2>
<hr />
<p>
    Yii 2.0 добавляет класс [[yii\web\View|View]], который представляет часть V-представление рисунка MVC. Он может быть сконфигурирован глобально через компонент приложения "View". Он также доступен в любом представлении как $this. Это одно из самых больших изменений по сравнению с 1.1: $this в представлении больше не относится к контроллеру или объекту виджета. Это относится к объекту представления, который используется для создания файла представления. Для доступа к контроллеру или объекту виджета, теперь вы должны использовать $this->context.
</p>
<p>
    Т.к. вы можете получить доступ к объекту представления через компонент приложения "view", то теперь вы можете сделать (render) файл представления вроде следующего в любом месте вашего кода, не обязательно в контроллере или виджете:<br />
    <?php
    highlight_string("<?php
\$content = Yii::\$app->view->renderFile(\$viewFile, \$params);
// You can also explicitly create a new View instance to do the rendering
// \$view = new View();
// \$view->renderFile(\$viewFile, \$params);
?>");
    ?>
</p>
<p>
    Кроме того, больше не существует CClientScript в Yii 2.0. Класс [[yii\web\View|View]] взял на себя его роль со значительными улучшениями. Для более подробной информации, пожалуйста, см. подраздел "assets".
</p>
<p>
    Хотя Yii 2.0 продолжает использовать PHP в качестве своего основного языка шаблонов, но теперь Yii 2.0 поставляется с двумя официальными расширениями, для которых добавлена поддержка двух популярных шаблонизатора: Smarty и Twig. Шаблонизатор Prado больше не поддерживается. Для использования этих шаблонизаторов, нужно просто использовать tpl как расширение файла для ваших Smarty представлений, или twig для Twig представлений. Вы также можете настроить свойство [[yii\web\View::$renderers|View::$renderers]] для использования других шаблонизаторов. Смотрите раздел использование шаблонизаторов в руководстве для более подробной информации.
</p>
<p>
    Больше информации смотрите в разделе представления.
</p>
<h2>
    Модели
</h2>
<hr />
<p>
    Модель теперь связана с именем формы, возвращаемым от метода [[yii\base\Model::formName()|formName()]]. Это в основном используется при использовании HTML формы для сбора данных, вводимых пользователем для модели. Ранее в 1.1, это, как правило, жестко кодировалось как имя класса модели.
</p>

New methods called [[yii\base\Model::load()|load()] and [[yii\base\Model::loadMultiple()|Model::loadMultiple()]] are introduced to simplify the data population from user inputs to a model. For example,
<p>
    Новые методы, вызываемые как [[yii\base\Model::load()|load()] и [[yii\base\Model::loadMultiple()|Model::loadMultiple()]] вводятся для упрощения передачи данных из формы в модель. Например,<br />
    <?php
    highlight_string("<?php
\$model = new Post();
if (\$model->load(\$_POST)) {...}
// which is equivalent to:
if (isset(\$_POST['Post'])) {
    \\model->attributes = \$_POST['Post'];
}

\$model->save();

\$postTags = [];
\$tagsCount = count(\$_POST['PostTag']);
while (\$tagsCount-- > 0) {
    \$postTags[] = new PostTag(['post_id' => \$model->id]);
}
Model::loadMultiple(\$postTags, \$_POST);
?>");
    ?>
</p>
<p>
    Yii 2.0 добавляет новый метод [[yii\base\Model::scenarios()|scenarios()]] для объявления атрибутов, которые требуют проверки ы конкретном сценарии. Классы-потомки должны переписать [[yii\base\Model::scenarios()|scenarios()]], чтобы вернуть список сценариев и соответствующих атрибутов, которые должны быть проверены, когда вызывается [[yii\base\Model::validate()|validate()]]. Например,<br />
    <?php
    highlight_string("<?php
public function scenarios()
{
    return [
        'backend' => ['email', 'role'],
        'frontend' => ['email', '!name'],
    ];
}
?>");
    ?>
</p>
<p>
    Этот способ также определяет какие атрибуты являются безопасными, а какие нет. В частности, учитывая сценарий, если атрибут указан в соответствующем списке атрибутов сценария в [[yii\base\Model::scenarios()|scenarios()]] и его имя указано без префикса '!', то этот атрибут считается безопасным.
</p>
<p>
    Из-за изменений указанных выше, Yii 2.0 больше не имеет валидатора «unsafe».
</p>
<p>
    Если ваша модель имеет только один сценарий (очень часто), то не надо переопределять метод [[yii\base\Model::scenarios()|scenarios()]] и все будет работать по-прежнему как в Yii 1.1.
</p>
<p>
    Чтобы узнать больше о моделях в Yii 2.0 смотрите в руководстве в разделе Модели.
</p>
<h2>
    Контроллеры
</h2>
<hr />
<p>
    Теперь методы [[yii\base\Controller::render()|render()]] и [[yii\base\Controller::renderPartial()|renderPartial()]] возвращают результаты рендеринга, а не непосредственно выводят их. Вы должны 'echo' их явно, например, <code>echo $this->render(...);</code>;.
</p>
<p>
    Чтобы узнать больше о контроллерах в Yii 2.0 смотрите в руководстве в разделе Контроллер.
</p>
<h2>
    Виджеты
</h2>
<hr />
<p>
    Использование виджета сделано более простым в Yii 2.0. Вы в основном используюте методы [[yii\base\Widget::begin()|begin()]], [[yii\base\Widget::end()|end()]] и [[yii\base\Widget::widget()|widget()]]. Например,<br />
    <?php
    highlight_string("<?php
// Note that you have to \"echo\" the result to display it
echo \\yii\\widgets\\Menu::widget(['items' => \$items]);

// Passing an array to initialize the object properties
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
    Ранее в 1.1, надо было ввести имена классов виджета в виде строк с помощью методов beginWidget(), endWidget() и widget() класса CBaseController. Подход выше получает лучшую поддержку IDE.
</p>
<p>
    Больше информации о виджетах смотрите в разделе представления.
</p>
<h2>
    Темы
</h2>
<hr />
<p>
    Темы работают совершенно по другому в Yii 2.0. В настоящее время они основаны на пути карты "перевести" представление источника в тематическое представление. Например, если путь карты для темы равен ['/web/views' => '/web/themes/basic'], то тематический версия для представления /web/views/site/index.php будет /web/themes/basic/site/index.php.
</p>
<p>
    По этой причине тема теперь может быть применена к любому представлению, даже если представление оказывается вне контекста контроллера или виджета.
</p>
<p>
    Больше не существует CThemeManager. Вместо этого тема является настраиваемым свойством компонента приложения "view".
</p>
<p>
    Больше информации о темах смотрите в разделе Темы.
</p>
<h2>
    Консольные приложения
</h2>
<hr />
<p>
    Консольные приложения в настоящее время состоят из контроллеров, как в веб-приложении. На самом деле, консольные контроллеры и веб-контроллеры расширяют тот же базовый класс контроллера.
</p>
<p>
    Каждый контроллер консоли похож на класс CConsoleCommand в 1.1. Он состоит из одного или нескольких действий. Вы используете Yii команду <?php highlight_string("<?php <route> ?>"); ?>, чтобы выполнить консольную команду, где <?php highlight_string("<?php <route> ?>"); ?> - это маршрут контроллера (например sitemap/index). Дополнительные анонимные аргументы передаются в качестве параметров в соответствующий метод действия контроллера, и именованные аргументы рассматриваются как варианты, объявленные в опциях($id).
</p>
<p>
    Yii 2.0 поддерживает автоматическую генерацию команды справочной информации из блоков комментариев.
</p>
<p>
    Больше информации о консольных приложениях смотрите в разделе Консольные приложения.
</p>
<h2>
    I18N
</h2>
<hr />
<p>
    Yii 2.0 удаляет date formatter и number formatter в пользу PECL intl PHP модуля.
</p>
<p>
    Перевод сообщений по-прежнему поддерживается, но управляется он с помощью компонента приложения "i18n". Компонент управляет набором источников сообщений, который позволяет использовать различные источники сообщений на основе категорий сообщений. Для получения дополнительной информации см. документацию класса I18N.
</p>
<h2>
    Фильтры действий
</h2>
<hr />
<p>
    Фильтры действий реализованы сейчас через поведения. Вы должны расширяться от [[yii\base\ActionFilter]], чтобы определить новый фильтр. Для использования фильтра, необходимо присоединить класс фильтра к контроллеру как поведение. Например, чтобы использовать фильтр [[yii\web\AccessControl]], вы должны иметь следующий код в контроллере:<br />
    <?php
    highlight_string("<?php
public function behaviors()
{
    return [
        'access' => [
            'class' => 'yii\\web\\AccessControl',
            'rules' => [
                ['allow' => true, 'actions' => ['admin'], 'roles' => ['@']],
            ],
        ],
    ];
}
?>");
    ?>
</p>
<p>
    Чтобы узнать больше о фильтрах в Yii 2.0 смотрите в руководстве в разделе Контроллер.
</p>
<h2>
    Assets
</h2>
<hr />
<p>
    Yii 2.0 представляет новую концепцию под названием asset bundle. Он похож на скриптовые пакеты (управляемые CClientScript) в 1.1, но с лучшей поддержкой.
</p>
<p>
    Asset bundle представляет собой набор файлов asset'ов (например, файлы JavaScript, CSS файлы, файлы изображений, и т.д.) в директории. Каждый asset bundle представлен ​​как класс, расширяющий [[yii\web\AssetBundle]]. При регистрации asset bundle'ов с помощью [[yii\web\AssetBundle::register()]], вы сможете сделать assets'ы в этом bundle'е доступными через Web, и текущая страница будет автоматически содержать ссылки на JavaScript и CSS файлы, указанные в этом bundle'е.
</p>
<p>
    Чтобы узнать больше о assets'ах в Yii 2.0 смотрите в руководстве в разделе управление asset'ами.
</p>
<h2>
    Статические помощники
</h2>
<hr />
<p>
    Yii 2.0 вводит многие часто используемые статические вспомогательные классы, такие как [[yii\helpers\Html|Html]], [[yii\helpers\ArrayHelper|ArrayHelper]], [[yii\helpers\StringHelper|StringHelper]]. [[yii\helpers\FileHelper|FileHelper]], [[yii\helpers\Json|Json]], [[yii\helpers\Security|Security]], эти классы имеют такую архитектуру, что их легко расширять. Обратите внимание, что статические классы, как правило, трудно расширить, потому что их имена классов зафиксированны. Но Yii 2.0 вводит карту класса (с помощью [[Yii::$classMap]]), чтобы преодолеть эту трудность.
</p>
<h2>
    ActiveForm
</h2>
<hr />
<p>
    Yii 2.0 вводит понятие поля для построения формы с помощью [[yii\widgets\ActiveForm]]. Поле представляет собой контейнер, состоящий из label, input, сообщения об ошибке, и/или текста подсказки. Поле представлено ​​как объект [[yii\widgets\ActiveField|ActiveField]]. Используя поля, вы можете создать форму более аккуратно, чем раньше:<br />
    <?php
    highlight_string("<?php
<?php \$form = yii\\widgets\\ActiveForm::begin(); ?>
    <?= \$form->field(\$model, 'username') ?>
    <?= \$form->field(\$model, 'password')->passwordInput() ?>
    <div class=\"form-group\">
        <?= Html::submitButton('Login') ?>
    </div>
<?php yii\\widgets\\ActiveForm::end(); ?>
?>");
    ?>
</p>
<h2>
    Query Builder
</h2>
<hr />
<p>
    В версии 1.1 построения запросов распределяется среди нескольких классов, в том числе CDbCommand, CDbCriteria и CDbCommandBuilder. Yii 2.0 использует объект [[yii\db\Query|Query]] для представления DB запросов и [[yii\db\QueryBuilder|QueryBuilder]] для создания SQL выражения из объектов запроса. Например:<br />
    <?php
    highlight_string("<?php
\$query = new \\yii\\db\\Query();
\$query->select('id, name')
      ->from('tbl_user')
      ->limit(10);

\$command = \$query->createCommand();
\$sql = \$command->sql;
\$rows = \$command->queryAll();
?>");
    ?>
</p>
<p>
    Лучше всего такие методы построения запросов могут быть использованы вместе с [[yii\db\ActiveRecord|ActiveRecord]], как описано в следующем подразделе.
</p>
<h2>
    ActiveRecord
</h2>
<hr />
<p>
    [[yii\db\ActiveRecord|ActiveRecord]] значительно изменилась в Yii 2.0. Наиболее важным изменением является реляционный запрос ActiveRecord. В версии 1.1 вы должны объявить отношения в методе relations(). В версии 2.0, это делается с помощью getter методов, возвращающих объект [[yii\db\ActiveQuery|ActiveQuery]]. Например, следующий метод объявляет отношение "orders":<br />
    <?php
    highlight_string("<?php
class Customer extends \\yii\\db\\ActiveRecord
{
    public function getOrders()
    {
        return \$this->hasMany('Order', ['customer_id' => 'id']);
    }
}
?>");
    ?>
</p>
<p>
    Вы можете использовать $customer->orders для доступа к заказам потребителя. Вы также можете использовать $customer->getOrders()->andWhere('status=1')->all() для выполнения реляционных запросов на лету с индивидуальными условиями запроса.
</p>
<p>
    При загрузке реляционных записей жадным образом, Yii 2.0 делает это иначе, чем 1.1. В частности, в 1.1 JOIN запрос будет использоваться, чтобы вернуть первичные и реляционные записи, в то время как в 2.0, два SQL запроса выполняются без использования JOIN: первый запрос возвращает первичные записи, а второй запрос возвращает реляционные записи путем фильтрации с помощью первичных ключей в первичных записях.
</p>
<p>
    Yii 2.0 больше не использует метод model() при выполнении запросов. Вместо этого, вы используете метод [[yii\db\ActiveRecord::find()|find()]]:<br />
    <?php
    highlight_string("<?php
// to retrieve all *active* customers and order them by their ID:
\$customers = Customer::find()
    ->where(['status' => \$active])
    ->orderBy('id')
    ->all();
// return the customer whose PK is 1
\$customer = Customer::find(1);
?>");
    ?>
</p>
<p>
    Метод [[yii\db\ActiveRecord::find()|find()]] возвращает экземпляр класса [[yii\db\ActiveQuery|ActiveQuery]], который является подклассом для [[yii\db\Query]]. Таким образом, вы можете использовать все методы для запроса из [[yii\db\Query]].
</p>
<p>
    Вместо возвращения объектов ActiveRecord, вы можете вызвать метод [[yii\db\ActiveQuery::asArray()|ActiveQuery::asArray()]], чтобы вернуть результаты запроса в виде массивов. Это более эффективно, и это особенно полезно, когда вам нужно вернуть большое количество записей:<br />
    <?php
    highlight_string("<?php
\$customers = Customer::find()->asArray()->all();
?>");
    ?>
</p>
<p>
    По умолчанию ActiveRecord теперь сохраняет только грязные атрибуты. В версии 1.1 все атрибуты сохраняются в базе данных при вызове save(), независимо от того, изменились они или нет, если только вы явно не перечислили атрибуты для сохранения.
</p>
<p>
    Scopes в настоящее время определены в классе [[yii\db\ActiveQuery|ActiveQuery]] вместо модели напрямую.
</p>
<p>
    Для более подробной информации смотрите в руководстве раздел Active Record.
</p>
<h2>
    Авто-экранирование имен столбцов и таблиц
</h2>
<hr />
<p>
    Yii 2.0 поддерживает автоматическое экранирование имен таблиц и столбцов базы данных. Имена заключенные в двойные фигурные скобки, т.е. {{имя_таблицы}} рассматриваются как имя таблицы, а имя заключенное в двойные квадратные скобки т.е. [[имя_поля]] трактуется как имя столбца. Они будут экранироваться в соответствии с используемым драйвером базы данных:<br />
    <?php
    highlight_string("<?php
\$command = \$connection->createCommand('SELECT [[id]] FROM {{posts}}');
echo \$command->sql;  // MySQL: SELECT `id` FROM `posts`
?>");
    ?>
</p>
<p>
    Эта функция особенно полезна, если вы разрабатываете приложение, поддерживающее различные СУБД.
</p>
<h2>
    Пользователь и IdentityInterface
</h2>
<hr />
<p>
    Класс CWebUser в 1.1 теперь заменен на [[yii\web\User]], и больше нет класса CUserIdentity. Вместо этого, вы должны реализовать интерфейс [[yii\web\IdentityInterface]], который является гораздо более простым в реализации. Расширенный шаблон приложения предоставляет такой пример.
</p>
<h2>
    Управление URL
</h2>
<hr />
<p>
    Управление URL похоже на 1.1. Значительно усовершенствовано в том смысле, что теперь он поддерживает необязательные параметры. Например, если у вас есть правило объявленное следующим образом, то это будет соответствовать и post/popular и post/1/popular. В версии 1.1 вам придется использовать два правила для достижения той же цели.<br />
    <?php
    highlight_string("<?php
[
    'pattern' => 'post/<page:\\d+>/<tag>',
    'route' => 'post/index',
    'defaults' => ['page' => 1],
]
?>");
    ?>
</p>
<p>
    Для того, чтобы узнать больше, обратитесь к разделу руководства Управление URL.
</p>
<h2>
    Ответ
</h2>
<hr />
<p>
    Подлежит обсуждению
</p>
<h2>
    Расширения
</h2>
<hr />
<p>
    Yii 1.1 расширения не совместимы с Yii 2.0, так что вы должны портировать или переписать их. Для того чтобы получить более подробную информацию о расширениях в Yii 2.0 смотрите раздел Расширения.
</p>
<h2>
    Интеграция с Composer
</h2>
<hr />
<p>
    Yii полностью интегрируется с Composer'ом, известный менеджер пакетов для PHP, который разрешает зависимости, помогает держать ваш код в курсе, позволяя обновлять его с помощью одной команды консоли и не настраивать вручную автозагрузку для сторонних библиотек.
</p>
<p>
    Для того, чтобы узнать больше, обратитесь к разделам руководства Composer и Установка.
</p>
<h2>
    Использование Yii 1.1 и 2.x вместе
</h2>
<hr />
<p>
    Смотрите <a href="/yiisoft/yii2/blob/master/docs/guide/using-3rd-party-libraries.md" target="_blank">using Yii together with 3rd-Party Systems</a>
</p>
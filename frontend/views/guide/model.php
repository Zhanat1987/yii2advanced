<h1>
    Модель
</h1>
<hr />
<p>
    В соответствии с подходом MVC, модель в Yii предназначена для хранения или временного представления данных приложения. Модели в Yii имеют следующие основные характеристики:<br />
    <ul>
        <li>Описание атрибута: модель определяет, что считается атрибутом.</li>
        <li>Label атрибута: каждый атрибут может быть связан с меткой для отображения.</li>
        <li>Массивное назначение атрибута: способность заполнить несколько атрибутов модели за раз.</li>
        <li>Проверка данных на основе сценария.</li>
    </ul>
</p>
<p>
    Модели в Yii расширяются от класса [[\yii\base\Model]].
    Модели, как правило, используется для хранения данных и задания правил для валидации данных (бизнес-логики).
    Бизнес-логика значительно упрощает поколение моделей сложных веб-форм, обеспечивая проверку и отчеты об ошибках.
</p>
<p>
    Класс [[\yii\base\Model]] яв-ся также базовым классом для более продвинутых моделей с дополнительной функциональностью, таких как Active Record.
</p>
<h2>
    Атрибуты
</h2>
<hr />
<p>
    Фактические данные, представленные в модели хранятся в атрибутах модели.
    Атрибуты модели могут быть доступны как переменные любого объекта.
    Например, модель Post может содержать атрибут title и атрибут content, доступных следующим образом:<br />
    <?php
    highlight_string("<?php
\$post = new Post;
\$post->title = 'Hello, world';
\$post->content = 'Something interesting is happening.';
echo \$post->title;
echo \$post->content;
?>");
    ?>
</p>
<p>
    Так как [[\yii\base\Model|Model]] реализует интерфейс ArrayAccess, вы также можете получить доступ к атрибутам, как если бы они были элементами массива:<br />
    <?php
    highlight_string("<?php
\$post = new Post;
\$post['title'] = 'Hello, world';
\$post['content'] = 'Something interesting is happening';
echo \$post['title'];
echo \$post['content'];
?>");
    ?>
</p>
<p>
    По умолчанию [[\yii\base\Model|Model]] требует, чтобы атрибуты были объявлены как public и non-static атрибуты класса. В следующем примере, модель LoginForm объявляет два атрибута: имя пользователя и пароль.<br />
    <?php
    highlight_string("<?php
// LoginForm has two attributes: username and password
class LoginForm extends \yii\base\Model
{
    public \$username;
    public \$password;
}
?>");
    ?>
</p>
<p>
    Производные классы модели могут объявлять атрибуты по-разному, путем переопределения метода [[\yii\base\Model::attributes()|attributes()]].
    Например, [[\yii\db\ActiveRecord]] определяет атрибуты, используя имена столбцов таблицы базы данных, связанных с классом.
</p>
<h2>
    Label'ы атрибутов
</h2>
<hr />
<p>
    Label'ы атрибутов в основном используются для улучшения отображения.
    Например, если атрибут = firstName, мы можем объявить label = 'First Name', который является более удобным для пользователей, когда отображается для конечных пользователей в таких местах, как label'ы формы и сообщения об ошибках.
    Учитывая имя атрибута, вы можете получить его label вызовом метода [[\yii\base\Model::getAttributeLabel()]].
</p>
<p>
    Чтобы объявить label'ы полей, надо переопределить метод [[\yii\base\Model::attributeLabels()]].
    Переопределенный метод возвращает массив, в котором ключом яв-ся атрибут модели, а значение яв-ся label'ом.
    Если атрибут не найден в этом массиве, то label будет генерироваться с помощью метода [[\yii\base\Model::generateAttributeLabel()]].
    Во многих случаях [[\yii\base\Model::generateAttributeLabel()]] будет генерировать разумные label'ы (например username в Username, orderNumber в Order Number).<br />
    <?php
    highlight_string("<?php
// LoginForm has two attributes: username and password
class LoginForm extends \yii\base\Model
{
    public \$username;
    public \$password;

    public function attributeLabels()
    {
        return [
            'username' => 'Your name',
            'password' => 'Your password',
        ];
    }
}
?>");
    ?>
</p>
<h2>
    Сценарии
</h2>
<hr />
<p>
    Модель может быть использована в различных сценариях.
    Например, модель User может быть использована для авторизации или регистрации.
    В одном сценарии, каждый атрибут требуется, а в другом, только имя пользователя и пароль.
</p>
<p>
    Чтобы легко реализовать бизнес-логику для различных сценариев, каждая модель имеет свойство сценарий, который хранит имя сценария, что модель в настоящее время использует.
    Как будет объяснено в следующих разделах, концепция сценариев в основном используется для проверки данных и массивном назначении атрибутов.
</p>
<p>
    С каждым сценарием ассоциируется список атрибутов, которые активны в этом конкретном случае.
    Например, в сценарии входа в систему, активны только атрибуты имя пользователя и пароль; в то время как в сценарии регистрации, дополнительные атрибуты, такие как электронная почта являются активными. Когда атрибут активен это означает, что оно подлежит проверке.
</p>
<p>
    Возможные сценарии должны быть перечислены в методе scenarios(). Этот метод возвращает массив, ключи которого являются именами сценария и, значения которых списки атрибутов, которые должны быть активны в этом сценарии:<br />
    <?php
    highlight_string("<?php
class User extends \yii\db\ActiveRecord
{
    public function scenarios()
    {
        return [
            'login' => ['username', 'password'],
            'register' => ['username', 'email', 'password'],
        ];
    }
}
?>");
    ?>
</p>
<p>
    Если метод сценарии не определен, применяется сценарий по умолчанию. Это означает, что атрибуты с правилами проверки считаются активными.
</p>
<p>
    Если вы хотите сохранить сценарий по умолчанию доступным, кроме ваших собственных сценариев, то надо использовать наследование, чтобы включить его:<br />
    <?php
    highlight_string("<?php
class User extends \yii\db\ActiveRecord
{
    public function scenarios()
    {
        \$scenarios = parent::scenarios();
        \$scenarios['login'] = ['username', 'password'];
        \$scenarios['register'] = ['username', 'email', 'password'];
        return \$scenarios;
    }
}
?>");
    ?>
</p>
<p>
    Иногда мы хотим отметить атрибут как небезопасный для массивного присваивания (но мы все еще хотим валидировать атрибут). Мы можем сделать это с помощью префикса восклицательный знак в имени атрибута при объявлении его в scenarios(). Например:<br />
    <?php highlight_string("<?php ['username', 'password', '!secret'] ?>"); ?>
</p>
<p>
    В этом примере username, password и secret являются активными атрибутами, но только username и password считаются безопасными для массивного назначения.<br />
</p>
<p>
    Пример установки текущего сценария модели:<br />
    <?php
    highlight_string("<?php
class EmployeeController extends \yii\web\Controller
{
    public function actionCreate(\$id = null)
    {
        // first way
        \$employee = new Employee(['scenario' => 'managementPanel']);

        // second way
        \$employee = new Employee;
        \$employee->scenario = 'managementPanel';

        // third way
        \$employee = Employee::find()->where('id = :id', [':id' => \$id])->one();
        if (\$employee !== null) {
            \$employee->scenario = 'managementPanel';
        }
    }
}
?>");
    ?>
</p>
<p>
    В приведенном выше примере предполагается, что модель основана на Active Record. Для базовых моделей форм, сценарии редко необходимы, так как базовая модель формы, как правило, напрямую связана с одной формой и, как отмечалось выше, реализация по умолчанию из scenarios() возвращает все свойства с правилом активной проверки делает его всегда доступным для массового присваивания и валидации.
</p>
<h2>
    Валидация
</h2>
<hr />
<p>
    Когда модель используется для сбора входных данных пользователя через его атрибуты, для этого обычно нужно для проверки измененных атрибутов, чтобы убедиться, что они удовлетворяют определенным требованиям, таким как - атрибут не может быть пустым, атрибут должен содержать только буквы, и т.д. Если ошибки найти в валидации, то они могут быть представлены пользователю, чтобы помочь ему исправить ошибки. В следующем примере показано, как выполняется валидация:<br />
    <?php
    highlight_string("<?php
\$model = new LoginForm;
\$model->username = \$_POST['username'];
\$model->password = \$_POST['password'];
if (\$model->validate()) {
    // ... login the user ...
} else {
    \$errors = \$model->getErrors();
    // ... display the errors to the end user ...
}
?>");
    ?>
</p>
<p>
    Возможные правила валидации для модели должны быть перечислены в его методе rules(). Каждое правило проверки относится к одному или нескольким атрибутам и является эффективным в одном или нескольких сценариях. Правило может быть указано с помощью объекта валидатор - экземпляр [[\yii\validators\Validator]] дочернего класса, или массив в следующем формате:<br />
    <?php
    highlight_string("<?php
[
    ['attribute1', 'attribute2', ...],
    'validator class or alias',
    // specifies in which scenario(s) this rule is active.
    // if not given, it means it is active in all scenarios
    'on' => ['scenario1', 'scenario2', ...],
    // the following name-value pairs will be used
    // to initialize the validator properties
    'property1' => 'value1',
    'property2' => 'value2',
    // ...
]
?>");
    ?>
</p>
<p>
    При вызыве метода validate(), фактические правила проверки, определяются с использованием обоих следующих критериев:<br />
    <ol>
        <li>Правило должно быть связано с по меньшей мере одним активным атрибутом.</li>
        <li>Правило должно быть активным для текущего сценария.</li>
    </ol>
</p>
<h2>
    Создание собственных валидаторов (встроенные валидаторы)
</h2>
<hr />
<p>
    Если ни один из встроенных валидаторов не соответствует вашим потребностям, вы можете создать свой собственный валидатор, создав метод в модели. Этот метод будет обернут [[InlineValidator|yii\validators\InlineValidator]] для валидации. Вы будете делать проверку атрибута и вызывать метод [[add errors|yii\base\Model::addError()]], если не соответствует правилу валидации, то добавить ошибку.
</p>
<p>
    Метод имеет следующую структуру public function myValidator($attribute, $params) в то время как вы можете выбрать имя.
</p>
<p>
    Вот пример реализации валидатора, проверяющего возраст пользователя:<br />
    <?php
    highlight_string("<?php
public function validateAge(\$attribute, \$params)
{
    \$value = \$this->\$attribute;
    if (strtotime(\$value) > strtotime('now - ' . \$params['min'] . ' years')) {
        \$this->addError(\$attribute, 'You must be at least ' . \$params['min'] . ' years old to register for this service.');
    }
}

public function rules()
{
    return [
        // ...
        [['birthdate'], 'validateAge', 'params' => ['min' => '12']],
    ];
}
?>");
    ?>
</p>
<p>
    Вы также можете установить другие свойства [[InlineValidator|yii\validators\InlineValidator]] в определении правил, например в свойство [[skipOnEmpty|yii\validators\InlineValidator::skipOnEmpty]]:
</p>
<h2>
    Массовое чтение и присваивание атрибутов
</h2>
<hr />
<p>
    Атрибуты могут быть массово получены через свойства атрибутов. Следующий код возвращает все атрибуты модели $post в виде массива пар имя-значение:<br />
    <?php
    highlight_string("<?php
\$post = Post::find(42);
if (\$post) {
    \$attributes = \$post->attributes;
    var_dump(\$attributes);
}
?>");
    ?>
</p>
<p>
    Используя свойство attributes вы можете массово назначать данные из ассоциативного массива в атрибуты модели:<br />
    <?php
    highlight_string("<?php
\$post = new Post();
\$attributes = [
    'title' => 'Massive assignment example',
    'content' => 'Never allow assigning attributes that are not meant to be assigned.',
];
\$post->attributes = \$attributes;
var_dump(\$attributes);
?>");
    ?>
</p>
<p>
    В приведенном выше коде мы присваиваем соответствующие данные для атрибутов модели с именами в качестве ключей массива. Ключевое отличие от массового извлечения, что всегда работает для всех атрибутов в том, что для того, чтобы атрибут был назначенным, он должен быть safe (безопасным), иначе он будет игнорироваться.
</p>
<h2>
    Правила проверки и массового назначения
</h2>
<hr />
<p>
    Yii2 в отличие Yii 1.x правила проверки отделены от массового назначения. Правила проверки описаны в методе модели rules(), в то время как то, что это безопасно для массового назначения описывается в методе scenarios:<br />
    <?php
    highlight_string("<?php
class User extends ActiveRecord
{
    public function rules()
    {
        return [
            // rule applied when corresponding field is 'safe'
            ['username', 'string', 'length' => [4, 32]],
            ['first_name', 'string', 'max' => 128],
            ['password', 'required'],

            // rule applied when scenario is 'signup' no matter if field is 'safe' or not
            ['hashcode', 'check', 'on' => 'signup'],
        ];
    }

    public function scenarios()
    {
        return [
            // on signup allow mass assignment of username
            'signup' => ['username', 'password'],
            'update' => ['username', 'first_name'],
        ];
    }
}
?>");
    ?>
</p>
<p>
    В коде выше массовое назначение будет разрешено строго в соответствии с scenarios():<br />
    <?php
    highlight_string("<?php
\$user = User::find(42);
\$data = ['password' => '123'];
\$user->attributes = \$data;
print_r(\$data);
?>");
    ?>
</p>
<p>
    Вернет пустой массив, так как сценарий по умолчанию не определен в методе scenarios().
</p>
<p>
    <?php
    highlight_string("<?php
\$user = User::find(42);
\$user->scenario = 'signup';
\$data = [
    'username' => 'samdark',
    'password' => '123',
    'hashcode' => 'test',
];
\$user->attributes = \$data;
print_r(\$data);
?>");
    ?>
    <br />
    Вернет следующее:
    <br />
    <?php
    highlight_string("<?php
array(
    'username' => 'samdark',
    'first_name' => null,
    'password' => '123',
    'hashcode' => null, // it's not defined in scenarios method
)
?>");
    ?>
</p>
<p>
    Пример, когда метод scenarios() не определен:<br />
    <?php
    highlight_string("<?php
class User extends ActiveRecord
{
    public function rules()
    {
        return [
            ['username', 'string', 'length' => [4, 32]],
            ['first_name', 'string', 'max' => 128],
            ['password', 'required'],
        ];
    }
}
?>");
    ?>
</p>
<p>
    Этот код предполагает сценарий по умолчанию, так массовое назначения будет доступно для всех полей определенных в методе rules():<br />
    <?php
    highlight_string("<?php
\$user = User::find(42);
\$data = [
    'username' => 'samdark',
    'first_name' => 'Alexander',
    'last_name' => 'Makarov',
    'password' => '123',
];
\$user->attributes = \$data;
print_r(\$data);
?>");
    ?>
    <br />
    Вернет следующее:
    <br />
    <?php
    highlight_string("<?php
array(
    'username' => 'samdark',
    'first_name' => 'Alexander',
    'password' => '123',
)
?>");
    ?>
</p>
<p>
    Если вы хотите, чтобы некоторые поля были unsafe (небезопасными) для сценария по умолчанию:<br />
    <?php
    highlight_string("<?php
class User extends ActiveRecord
{
    function rules()
    {
        return [
            ['username', 'string', 'length' => [4, 32]],
            ['first_name', 'string', 'max' => 128],
            ['password', 'required'],
        ];
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_DEFAULT => ['username', 'first_name', '!password']
        ];
    }
}
?>");
    ?>
</p>
<p>
    Массового присваивание по-прежнему доступно по умолчанию:<br />
    <?php
    highlight_string("<?php
\$user = User::find(42);
\$data = [
    'username' => 'samdark',
    'first_name' => 'Alexander',
    'password' => '123',
];
\$user->attributes = \$data;
print_r(\$user->attributes);
?>");
    ?>
    <br />
    Вернет следующее:
    <br />
    <?php
    highlight_string("<?php
array(
    'username' => 'samdark',
    'first_name' => 'Alexander',
    'password' => null, // because of ! before field name in scenarios
)
?>");
    ?>
</p>
<h2>
    Смотрите также
</h2>
<hr />
<ul>
    <li>
        <a href="https://github.com//yiisoft/yii2/blob/master/docs/guide/validation.md" target="_blank">
            Model validation reference
        </a>
    </li>
    <li>
        <a href="http://stuff.cebe.cc/yii2docs/yii_base_model.html" target="_blank">
            [[\yii\base\Model]]
        </a>
    </li>
</ul>
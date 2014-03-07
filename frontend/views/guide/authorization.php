<h1>
    Авторизация
</h1>
<hr />
<p>
    Авторизация - это процесс проверки того, что пользователь имеет достаточно
    прав, чтобы сделать что-то.
    Yii предоставляет несколько способов управления авторизации.
</p>
<h2>
    Основы контроля доступа
</h2>
<hr />
<p>
    Основы контроля доступа очень просто реализовать с помощью [[yii\web\AccessControl]]:<br />
    <?php
    highlight_string("<?php
class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \\yii\\web\\AccessControl::className(),
                'only' => ['login', 'logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['login', 'signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    // ...
?>");
    ?>
</p>
<p>
    В приведенном выше коде показано как прикрепить поведение контроля доступа к контроллеру.
    Т.к. задан ключ 'only', то оно будет применено только к 'login', 'logout', 'signup'.
    Набор правил, указанных в ключе 'rules' для [[yii\web\AccessRule]],
    означает следующее:
</p>
<ul>
    <li>Разрешить всем гостям (роль = guest) (т.е. не авторизованным пользователям)
        получать доступ к действиям 'login' и 'signup' текущего контроллера.</li>
    <li>Разрешить авторизованным пользователям доступ к действию 'logout' текущего
        контроллера.</li>
</ul>
<p>
    Правила проверяются один за другим сверху вниз. Если правило соответствует, действие происходит немедленно.
    Если нет, то следующее правило проверяется. Если правила не согласованы, то в
    доступе будет отказано.
</p>
<p>
    [[yii\web\AccessRule]] является достаточно гибким и позволяет дополнительно к тому, что было продемонстрировано,
    еще и проверку IP-адреса и метода запроса (т.е. POST, GET). Если этого не достаточно, то вы можете задать свое собственное правило проверки через анонимную функцию:<br />
    <?php
    highlight_string("<?php
class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \\yii\\web\\AccessControl::className(),
                'only' => ['special-callback'],
                'rules' => [
                    [
                        'actions' => ['special-callback'],
                        'allow' => true,
                        'matchCallback' => function (\$rule, \$action) {
                            return date('d-m') === '31-10';
                        }
                    ],
?>");
    ?>
</p>
<p>
    И действие:<br />
    <?php
    highlight_string("<?php
// ...
// Match callback called! This page can be accessed only each October 31st
public function actionSpecialCallback()
{
    return \$this->render('happy-halloween');
}
?>");
    ?>
</p>
<p>
    Иногда мы хотим переопределить действие, вызываемое при отказе в доступе.
    В этом случае вы можете указать denyCallback.
</p>
<h2>
    Контроль доступа на основе ролей (RBAC)
</h2>
<hr />
<p>
    Контроль доступа на основе ролей - это очень гибкий подход к контролю
    доступа,
    который идеально подходят для сложных систем, где разрешения можно
    настроить тонко.
</p>
Using file-based config for RBAC

In order to start using it some extra steps are required. First of all we need to configure authManager application component in application config file (web.php or main.php depending on template you've used):
<h2>
    Использование конфигурации на основе файлов для RBAC
</h2>
<hr />
<p>
    Для того чтобы начать его использовать, необходимы некоторые дополнительные шаги. Прежде всего нам нужно настроить компонент приложения authManager в конфигурационном файле приложения (web.php или main.php в зависимости от шаблона, который вы использовали):<br />
    <?php
    highlight_string("<?php
'authManager' => [
    'class' => 'app\\components\\PhpManager',
    'defaultRoles' => ['guest'],
],
?>");
    ?>
</p>
<p>
    Часто используемые роли хранятся в одной таблице базы данных,
    как и другие пользовательские данные. В этом случае мы можем определить его,
    создавая наш собственный компонент (app/components/PhpManager.php):<br />
    <?php
    highlight_string("<?php
<?php
namespace app\\components;

use Yii;

class PhpManager extends \\yii\\rbac\\PhpManager
{
    public function init()
    {
        parent::init();
        if (!Yii::\$app->user->isGuest) {
            // we suppose that user's role is stored in identity
            \$this->assign(Yii::\$app->user->identity->id,
            Yii::\$app->user->identity->role);
        }
    }
}
?>");
    ?>
</p>
<p>
    Затем создайте иерархию разрешений в @app/data/rbac.php:<br />
    <?php
    highlight_string("<?php
<?php
use yii\\rbac\\Item;

return [
    // HERE ARE YOUR MANAGEMENT TASKS
    'manageThing0' => ['type' => Item::TYPE_OPERATION, 'description' => '...', 'bizRule' => NULL, 'data' => NULL],
    'manageThing1' => ['type' => Item::TYPE_OPERATION, 'description' => '...', 'bizRule' => NULL, 'data' => NULL],
    'manageThing2' => ['type' => Item::TYPE_OPERATION, 'description' => '...', 'bizRule' => NULL, 'data' => NULL],
    'manageThing3' => ['type' => Item::TYPE_OPERATION, 'description' => '...', 'bizRule' => NULL, 'data' => NULL],

    // AND THE ROLES
    'guest' => [
        'type' => Item::TYPE_ROLE,
        'description' => 'Guest',
        'bizRule' => NULL,
        'data' => NULL
    ],

    'user' => [
        'type' => Item::TYPE_ROLE,
        'description' => 'User',
        'children' => [
            'guest',
            'manageThing0', // User can edit thing0
        ],
        'bizRule' => 'return !Yii::\$app->user->isGuest;',
        'data' => NULL
    ],

    'moderator' => [
        'type' => Item::TYPE_ROLE,
        'description' => 'Moderator',
        'children' => [
            'user',         // Can manage all that user can
            'manageThing1', // and also thing1
        ],
        'bizRule' => NULL,
        'data' => NULL
    ],

    'admin' => [
        'type' => Item::TYPE_ROLE,
        'description' => 'Admin',
        'children' => [
            'moderator',    // can do all the stuff that moderator can
            'manageThing2', // and also manage thing2
        ],
        'bizRule' => NULL,
        'data' => NULL
    ],

    'godmode' => [
        'type' => Item::TYPE_ROLE,
        'description' => 'Super admin',
        'children' => [
            'admin',        // can do all that admin can
            'manageThing3', // and also thing3
        ],
        'bizRule' => NULL,
        'data' => NULL
    ],

];
?>");
    ?>
</p>
<p>
    Теперь вы можете указать роли от RBAC в конфигурации управления доступом
    в контроллере:<br />
    <?php
    highlight_string("<?php
public function behaviors()
{
    return [
        'access' => [
            'class' => 'yii\\web\\AccessControl',
            'except' => ['something'],
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['manageThing1'],
                ],
            ],
        ],
    ];
}
?>");
    ?>
</p>
<p>
    Другой способ заключается в вызове [[yii\web\User::checkAccess()]] в случае необходимости.
</p>
<h3>
    Использование БД, как основа для хранения RBAC
</h3>
<p>
    Хранение иерархии RBAC в базе данных является менее эффективным,
    с точки зрения производительности, но является гораздо более гибким.
    Легче создать хороший пользовательский интерфейс для управления RBAC'ом,
    так в случае необходимости структура разрешений,
    которая управляется конечным пользователем, то DB это ваш выбор.
</p>
<p>
    Для того, чтобы начать работу необходимо настроить соединение с базой данных
    в компоненте db. После этого надо создать необходимые
    <a href="https://github.com/yiisoft/yii2/tree/master/framework/rbac">таблицы</a> в бд.
</p>
<p>
    Следующий шаг заключается в настройке компонента приложения authManager в
    конфигурационном файле приложения (web.php или main.php в зависимости от
    шаблона, который вы использовали):<br />
    <?php
    highlight_string("<?php
'authManager' => [
    'class' => 'yii\\rbac\\DbManager',
    'defaultRoles' => ['guest'],
],
?>");
    ?>
</p>
<p>
    Подлежит обсуждению
</p>
<h3>
    Как это работает
</h3>
<p>
    Подлежит обсуждению: написать о том, как он работает с фотографиями :)
</p>
<h3>
    Как избежать слишком много RBAC
</h3>
<p>
    Для того, чтобы сохранить иерархию аутентификации простой и эффективной следует избегать создания и использования слишком большого количества узлов. Большинство проверок можно сделать простым путем. Например такой код, который использует RBAC:<br />

    <?php
    highlight_string("<?php
public function editArticle(\$id)
{
  \$article = Article::find(\$id);
  if (!\$article) {
    throw new NotFoundHttpException;
  }
  if (!\\Yii::\$app->user->checkAccess('edit_article',
  ['article' => \$article])) {
    throw new ForbiddenHttpException;
  }
  // ...
}
?>");
    ?>
</p>
<p>
    может быть заменен на более простой код, который не использует RBAC:<br />
    <?php
    highlight_string("<?php
public function editArticle(\$id)
{
    \$article = Article::find(['id' => \$id,
    'author_id' => \\Yii::\$app->user->id]);
    if (!\$article) {
      throw new NotFoundHttpException;
    }
    // ...
}
?>");
    ?>
</p>
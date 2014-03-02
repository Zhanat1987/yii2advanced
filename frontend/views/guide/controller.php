<h1>
    Контроллер
</h1>
<hr />
<p>
    Контроллер является одной из ключевых частей приложения. Он определяет, как обрабатывать входящий запрос и создает ответ.
</p>
<p>
    Чаще всего контроллер принимает данные запроса HTTP и возвращает HTML, JSON или XML в качестве ответа.
</p>
<h2>
    Основы
</h2>
<hr />
<p>
    Контроллер находится в директории controllers приложения и назван как SiteController.php, где часть 'Site' может быть что угодно, описывает набор действий, которые он содержит.
</p>
<p>
    Основной веб-контроллер представляет собой класс, который наследуется от [[\yii\web\Controller]] и может быть очень простым:<br />
    <?php
    highlight_string("<?php
namespace app\controllers;

use yii\web\Controller;

class SiteController extends Controller
{
    public function actionIndex()
    {
        // will render view from \"views/site/index.php\"
        return \$this->render('index');
    }

    public function actionTest()
    {
        // will just print \"test\" to the browser
        return 'test';
    }
}
?>");
    ?>
</p>
<p>
    Как вы можете видеть, типичный контроллер содержит действия, которые являются public методами класса, названные как actionSomething. Отображением действия является то, что метод возвращает: это может быть строка или экземпляр [[yii\web\Response]], например. Возвращаемое значение будет обрабатываться response компонентом приложения, который может конвертировать отображение в различные форматы, такие как JSON например. Поведение по умолчанию - это отображения значения, если не изменять.
</p>
<p>
    Вы также можете отключить проверку CSRF каждого контроллера и/или действия, установив его свойство:<br />
    <?php
    highlight_string("<?php
namespace app\controllers;

use yii\web\Controller;

class SiteController extends Controller
{
    public \$enableCsrfValidation = false;

    public function actionIndex()
    {
        #CSRF validation will no be applied on this and other actions
    }

}
?>");
    ?>
</p>
<p>
    Чтобы отключить проверку CSRF для некоторых действий можно сделать:<br />
    <?php
    highlight_string("<?php
namespace app\controllers;

use yii\web\Controller;

class SiteController extends Controller
{
    public function beforeAction(\$action)
    {
        // ...set `\$this->enableCsrfValidation` here based on some conditions...
        // call parent method that will check CSRF if such property is true.
        return parent::beforeAction(\$action);
    }
}
?>");
    ?>
</p>
<h2>
    Маршруты
</h2>
<hr />
<p>
    Каждое действие Контроллера имеет соответствующий внутренний маршрут. В нашем примере выше actionIndex имеет маршрут = site/index и actionTest имеет маршрут = site/test. В этом маршруте 'site' - это ID контроллера, в то время как 'test' - это ID действия.
</p>
<p>
    По умолчанию вы можете получить доступ к конкретному контроллеру и действию с помощью URL = http://example.com/?r=controller/action. Такое поведение является полностью настраиваемым. Для получения подробной информации смотрите раздел URL Management.
</p>
<p>
    Если контроллер находится внутри модуля, то его внутренний маршрут для действие будет - module/controller/action.
</p>
<p>
    В случае если не будет найден указанный модуль, контроллер или действие, то Yii вернет страницу "Not Found" и код состояния HTTP 404.
</p>
<blockquote>
    <p>
        Примечание: Если имя модуля, имя контроллера или имя действия содержит camelCased слова, то внутренний маршрут будет использовать тире, то есть для DateTimeController::actionFastForward маршрут будет = date-time/fast-forward.
    </p>
</blockquote>
<h3>
    По умолчанию
</h3>
<p>
    Если пользователь не указал специальный маршрут, т.е. с использованием URL, как http://example.com/, Yii предполагает, что маршрут по умолчанию следует использовать. Она определяется методом [[\yii\web\Application::defaultRoute]] и 'site' по умолчанию означает, что будет загружен SiteController.
</p>
<p>
    Контроллер имеет действие по умолчанию. Когда запрос пользователя не указывает какое действие надо выполнить с помощью URL, такие как http://example.com/?r=site, то будет выполняться действие по умолчанию. Действие по умолчанию называется 'index'. Это можно изменить путем установки свойства [[\yii\base\Controller::defaultAction]].
</p>
<h2>
    Параметры действия
</h2>
<hr />
<p>
    Как уже упоминалось простое действие может быть только public-методом названный actionSomething. Теперь мы рассмотрим пути получения параметров действия из HTTP.
</p>
<h3>
    Параметры действия
</h3>
<p>
    Вы можете определить именованные аргументы для действия, и они будут автоматически заполняться из соответствующих значений из $_GET. Это очень удобно, как из-за короткого синтаксиса, так и возможностью указания значения по умолчанию:<br />
    <?php
    highlight_string("<?php
namespace app\controllers;

use yii\web\Controller;

class BlogController extends Controller
{
    public function actionView(\$id, \$version = null)
    {
        \$post = Post::find(\$id);
        \$text = \$post->text;

        if (\$version) {
            \$text = \$post->getHistory(\$version);
        }

        return \$this->render('view', [
            'post' => \$post,
            'text' => \$text,
        ]);
    }
}
?>");
    ?>
</p>
<p>
    Действие выше можно вызвать с помощью http://example.com/?r=blog/view&id=42 или http://example.com/?r=blog/view&id=42&version=3. В первом случае version не указан, а используется значение параметра по умолчанию.
</p>
<h3>
    Получение данных из запроса
</h3>
<p>
    Если ваше действие работает с данными HTTP POST или имеет слишком много GET параметров, то можно положиться объект запроса, который доступен через \Yii::$app->request:<br />
    <?php
    highlight_string("<?php
namespace app\controllers;

use yii\web\Controller;
use yii\web\HttpException;

class BlogController extends Controller
{
    public function actionUpdate(\$id)
    {
        \$post = Post::find(\$id);
        if (!\$post) {
            throw new NotFoundHttpException;
        }

        if (\Yii::\$app->request->isPost) {
            \$post->load(\$_POST);
            if (\$post->save()) {
                \$this->redirect(['view', 'id' => \$post->id]);
            }
        }

        return \$this->render('update', ['post' => \$post]);
    }
}
?>");
    ?>
</p>
<h2>
    Автономные действия
</h2>
<hr />
<p>
    Если действие достаточно общее, то имеет смысл реализовать его в отдельный класс, чтобы иметь возможность использовать его снова. Создать actions/Page.php:<br />
    <?php
    highlight_string("<?php
namespace app\actions;

class Page extends \yii\base\Action
{
    public \$view = 'index';

    public function run()
    {
        return \$this->controller->render(\$view);
    }
}
?>");
    ?>
</p>
<p>
    Следующий код слишком прост для реализации в качестве отдельного действия, но дает представление о том, как это работает. Автономное действие можно использовать в контроллере следующим образом:<br />
    <?php
    highlight_string("<?php
class SiteController extends \yii\web\Controller
{
    public function actions()
    {
        return [
            'about' => [
                'class' => 'app\actions\Page',
                'view' => 'about',
            ],
        ];
    }
}
?>");
    ?>
</p>
<p>
    После этого вы можете получить доступ к действию, как http://example.com/?r=site/about.
</p>
<h2>
    Фильтры действия
</h2>
<hr />
<p>
    Фильтры действия реализованы через поведения. Вы должны наследоваться от ActionFilter, чтобы определить новый фильтр. Для использования фильтра, необходимо присоединить класс фильтра к контроллеру как поведение. Например, чтобы использовать фильтр [[yii\web\AccessControl]], вы должны иметь следующий код в контроллере:<br />
    <?php
    highlight_string("<?php
public function behaviors()
{
    return [
        'access' => [
            'class' => 'yii\web\AccessControl',
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
    Для того, чтобы узнать больше о контроле доступа, создан раздел authorization в руководстве. Два других фильтра - [[yii\web\PageCache]] и [[yii\web\HttpCache]] описаны в разделе кэширования в руководстве.
</p>
<h2>
    Ловить все входящие запросы
</h2>
<hr />
<p>
    подлежит определению
</p>
<h2>
    Пользовательский класс Response (ответ):
</h2>
<hr />
<p>
    <?php
    highlight_string("<?php
namespace app\controllers;

use yii\web\Controller;
use app\components\web\MyCustomResponse; #extended from yii\web\Response

class SiteController extends Controller
{
    public function actionCustom()
    {
        /*
         * do your things here
         * since Response in extended from yii\base\Object, you can initialize its values by passing in
         * __constructor() simple array.
         */
        return new MyCustomResponse(['data' => \$myCustomData]);
    }
}
?>");
    ?>
</p>
<h2>
    Смотрите также
</h2>
<hr />
<ul>
    <li>
        <a href="https://github.com/yiisoft/yii2/blob/master/docs/guide/console.md" target="_blank">
            Console
        </a>
    </li>
</ul>
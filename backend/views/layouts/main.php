<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

/**
 * @var \yii\web\View $this
 * @var string $content
 */
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Yii 2',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => \Yii::t('guide', 'Others'), 'items' => [
            '<li class="divider"></li>',
            '<li class="dropdown-header">' . \Yii::t('guide', 'Advanced Topics') . '</li>',
            ['label' => \Yii::t('guide', 'Testing'), 'url' => ['/guide/testing']],
            '<li class="divider"></li>',
            '<li class="dropdown-header">' . \Yii::t('guide', 'Theming') . '</li>',
            ['label' => \Yii::t('guide', 'Theming'), 'url' => ['/theming']],
            ['label' => 'есть в "themes/views", но нет в "views"', 'url' => ['/theming/index2']],
            [
                'label' => 'нет в первой указанной теме, но есть во второй теме',
                'url' => ['/theming/index3']
            ],
            [
                'label' => 'нет ни в одной из указанных тем,
                но есть в представлениях',
                'url' => ['/theming/index4']
            ],
            '<li class="divider"></li>',
            '<li class="dropdown-header">' . \Yii::t('guide', 'Bootstrap widgets') . '</li>',
            [
                'label' => 'Основы',
                'url' => ['/bootstrap-widgets']
            ],
            [
                'label' => 'Виджеты',
                'url' => ['/bootstrap-widgets/widgets']
            ],
            [
                'label' => 'Использование .less файлов напрямую в Bootstrap',
                'url' => ['/bootstrap-widgets/less']
            ],
            '<li class="divider"></li>',
            '<li class="dropdown-header">' . \Yii::t('guide', 'Console applications') . '</li>',
            [
                'label' => \Yii::t('guide', 'Console applications'),
                'url' => ['/console']
            ],
            '<li class="divider"></li>',
            '<li class="dropdown-header">' . \Yii::t('guide', 'Working with forms') . '</li>',
            [
                'label' => \Yii::t('guide', 'Working with forms'),
                'url' => ['/working-with-forms']
            ],
            '<li class="divider"></li>',
            '<li class="dropdown-header">' . \Yii::t('guide', 'Caching') . '</li>',
            ['label' => \Yii::t('guide', 'Caching'), 'url' => ['/caching']],
            '<li class="divider"></li>',
            '<li class="dropdown-header">' . \Yii::t('guide', 'Bootstrap widgets') . '</li>',
            [
                'label' => \Yii::t('guide', 'Internationalization'),
                'url' => ['/guide/internationalization']
            ],
            '<li class="divider"></li>',
            '<li class="dropdown-header">' . \Yii::t('guide', 'Bootstrap widgets') . '</li>',
            ['label' => \Yii::t('guide', 'URL Management'), 'url' => ['/guide/url']],
            '<li class="divider"></li>',
            '<li class="dropdown-header">' . \Yii::t('guide', 'Bootstrap widgets') . '</li>',
            [
                'label' => \Yii::t('guide', 'Performance Tuning'),
                'url' => ['/guide/performance']
            ],
            '<li class="divider"></li>',
            '<li class="dropdown-header">' . \Yii::t('guide', 'Bootstrap widgets') . '</li>',
            [
                'label' => \Yii::t('guide', 'Managing assets'),
                'url' => ['/guide/assets']
            ],
            '<li class="divider"></li>',
            '<li class="dropdown-header">' . \Yii::t('guide', 'Bootstrap widgets') . '</li>',
            '<li class="divider"></li>',
            '<li class="dropdown-header">' . \Yii::t('guide', 'References') . '</li>',
            [
                'label' => \Yii::t('guide', 'Model validation reference'),
                'url' => ['/guide/validation']
            ],
        ]
        ],
        ['label' => \Yii::t('guide', 'Guide'), 'items' => [
            '<li class="divider"></li>',
            '<li class="dropdown-header">' . \Yii::t('guide', 'Introduction') . '</li>',
            ['label' => \Yii::t('guide', 'What is Yii'), 'url' => ['/guide/what-is-yii']],
            '<li class="divider"></li>',
            '<li class="dropdown-header">' . \Yii::t('guide', 'Getting started') . '</li>',
            [
                'label' => \Yii::t('guide', 'Advanced application template'),
                'url' => ['/guide/advanced-template']
            ],
            [
                'label' => \Yii::t('guide', 'Configuration'),
                'url' => ['/guide/configuration']
            ],
            [
                'label' => \Yii::t('guide', 'Creating your own Application structure'),
                'url' => ['/guide/apps-own']
            ],
            [
                'label' => \Yii::t('guide', 'Basic application template'),
                'url' => ['/guide/apps-basic']
            ],
            [
                'label' => \Yii::t('guide', 'Installation'),
                'url' => ['/guide/installation']
            ],
            [
                'label' => \Yii::t('guide', 'Upgrading from Yii 1.1'),
                'url' => ['/guide/upgrade-from-v1']
            ],
            '<li class="divider"></li>',
            '<li class="dropdown-header">' . \Yii::t('guide', 'Base concepts') . '</li>',
            [
                'label' => \Yii::t('guide', 'Basic concepts of Yii'),
                'url' => ['/guide/basic-concepts']
            ],
            ['label' => \Yii::t('guide', 'MVC Overview'), 'url' => ['/guide/m-v-c']],
            ['label' => \Yii::t('guide', 'Model'), 'url' => ['/guide/model']],
            ['label' => \Yii::t('guide', 'View'), 'url' => ['/guide/view']],
            ['label' => \Yii::t('guide', 'Controller'), 'url' => ['/guide/controller']],
            ['label' => \Yii::t('guide', 'Events'), 'url' => ['/guide/events']],
            ['label' => \Yii::t('guide', 'Behaviors'), 'url' => ['/guide/behaviors']],
        ]
        ],
        ['label' => \Yii::t('guide', 'Additional topics'), 'items' => [
            '<li class="divider"></li>',
            '<li class="dropdown-header">' . \Yii::t('guide', 'Developers Toolbox') . '</li>',
            [
                'label' => \Yii::t('guide', 'Helper Classes'),
                'url' => ['/guide/helper-classes']
            ],
            [
                'label' => \Yii::t('guide', 'Debug toolbar and debugger'),
                'url' => ['/guide/module-debug']
            ],
            [
                'label' => \Yii::t('guide', 'The Gii code generation tool'),
                'url' => ['/guide/gii']
            ],
            [
                'label' => \Yii::t('guide', 'Error Handling'),
                'url' => ['/guide/error-handling']
            ],
            ['label' => \Yii::t('guide', 'Logging'), 'url' => ['/guide/logging']],
            '<li class="divider"></li>',
            '<li class="dropdown-header">'
            . \Yii::t('guide', 'Security and access control') .
            '</li>',
            [
                'label' => \Yii::t('guide', 'Authentication'),
                'url' => ['/guide/authentication']
            ],
            ['label' => \Yii::t('guide', 'Security'), 'url' => ['/guide/security']],
            ['label' => \Yii::t('guide', 'Authorization'), 'url' => ['/guide/authorization']],
            '<li class="divider"></li>',
            '<li class="dropdown-header">' .
            \Yii::t('guide', 'Extensions and 3rd party libraries') . '</li>',
            ['label' => \Yii::t('guide', 'Composer'), 'url' => ['/guide/composer']],
            [
                'label' => \Yii::t('guide', 'Using 3rd-Party Libraries'),
                'url' => ['/guide/using-3rd-party-libraries']
            ],
            ['label' => \Yii::t('guide', 'Extending Yii'), 'url' => ['/guide/extending-yii']],
            [
                'label' => \Yii::t('guide', 'Using template engines'),
                'url' => ['/guide/using-template-engines']
            ],
        ]
        ],
        ['label' => \Yii::t('guide', 'Database and Grids'), 'items' => [
            '<li class="divider"></li>',
            '<li class="dropdown-header">'
            . \Yii::t('guide', 'Data providers, lists and grids') .
            '</li>',
            ['label' => \Yii::t('guide', 'Overview'), 'url' => ['/guide/data-overview']],
            [
                'label' => \Yii::t('guide', 'Data providers'),
                'url' => ['/guide/data-providers']
            ],
            ['label' => \Yii::t('guide', 'Data widgets'), 'url' => ['/guide/data-widgets']],
            ['label' => \Yii::t('guide', 'Grid'), 'url' => ['/guide/grid']],
            '<li class="divider"></li>',
            '<li class="dropdown-header">' . \Yii::t('guide', 'Database') . '</li>',
            [
                'label' => \Yii::t('guide', 'Database basics'),
                'url' => ['/guide/database-basics']
            ],
            [
                'label' => \Yii::t('guide', 'Query Builder and Query'),
                'url' => ['/guide/query-builder']
            ],
            ['label' => \Yii::t('guide', 'Active Record'), 'url' => ['/guide/active-record']],
            [
                'label' => \Yii::t('guide', 'Database Migration'),
                'url' => ['/guide/database-migration']
            ],
        ]
        ],
//        ['label' => \Yii::t('guide', 'Contact'), 'url' => ['/site/contact']],
//        ['label' => \Yii::t('guide', 'Articles'), 'url' => ['/article/index']],
//        ['label' => \Yii::t('guide', 'Articles and tags'), 'url' => ['/article-tag/index']],
//        ['label' => \Yii::t('guide', 'Tags'), 'url' => ['/tag/index']],
//        ['label' => \Yii::t('guide', 'Categories'), 'url' => ['/category/index']],
        ['label' => \Yii::t('guide', 'Gii'), 'url' => ['/gii/default/index']],
//        ['label' => 'Frontend', 'url' => 'http://yii2translate.frontend/'],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = [
            'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
            'url' => ['/site/logout']
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?=
        Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

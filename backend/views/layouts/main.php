<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\widgets\Menu;

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
//            '<li class="divider"></li>',
//            '<li class="dropdown-header">' . \Yii::t('guide', 'Advanced Topics') . '</li>',
//            ['label' => \Yii::t('guide', 'Testing'), 'url' => ['/' . \Yii::$app->language . '/guide/testing']],
//            '<li class="divider"></li>',
        '<li class="dropdown-header">' . \Yii::t('guide', 'Theming') . '</li>',
        ['label' => \Yii::t('guide', 'Theming'), 'url' => ['/' . \Yii::$app->language . '/theming']],
        ['label' => 'есть в "themes/views", но нет в "views"', 'url' => ['/' . \Yii::$app->language . '/theming/index2']],
        [
            'label' => 'нет в первой указанной теме, но есть во второй теме',
            'url' => ['/' . \Yii::$app->language . '/theming/index3']
        ],
        [
            'label' => 'нет ни в одной из указанных тем,
                но есть в представлениях',
            'url' => ['/' . \Yii::$app->language . '/theming/index4']
        ],
//            '<li class="divider"></li>',
        '<li class="dropdown-header">' . \Yii::t('guide', 'Bootstrap widgets') . '</li>',
        [
            'label' => 'Основы',
            'url' => ['/' . \Yii::$app->language . '/bootstrap-widgets']
        ],
        [
            'label' => 'Виджеты',
            'url' => ['/' . \Yii::$app->language . '/bootstrap-widgets/widgets']
        ],
        [
            'label' => 'Использование .less файлов напрямую в Bootstrap',
            'url' => ['/' . \Yii::$app->language . '/bootstrap-widgets/less']
        ],
//            '<li class="divider"></li>',
        '<li class="dropdown-header">' . \Yii::t('guide', 'Console applications') . '</li>',
        [
            'label' => \Yii::t('guide', 'Console applications'),
            'url' => ['/' . \Yii::$app->language . '/console']
        ],
//            '<li class="divider"></li>',
        '<li class="dropdown-header">' . \Yii::t('guide', 'Working with forms') . '</li>',
        [
            'label' => \Yii::t('guide', 'Working with forms'),
            'url' => ['/' . \Yii::$app->language . '/working-with-forms']
        ],
//            '<li class="divider"></li>',
        '<li class="dropdown-header">' . \Yii::t('guide', 'Caching') . '</li>',
        ['label' => \Yii::t('guide', 'Caching'), 'url' => ['/' . \Yii::$app->language . '/caching']],
//            '<li class="divider"></li>',
//            '<li class="dropdown-header">' . \Yii::t('guide', 'Bootstrap widgets') . '</li>',
//            [
//                'label' => \Yii::t('guide', 'Internationalization'),
//                'url' => ['/' . \Yii::$app->language . '/guide/internationalization']
//            ],
//            '<li class="divider"></li>',
        '<li class="dropdown-header">' .
        \Yii::t('guide', 'URL Management') .
        '</li>',
        [
            'label' => \Yii::t('guide', 'URL Management'),
            'url' => ['/' . \Yii::$app->language . '/url']
        ],
        [
            'label' => \Yii::t('guide', 'beforeAction'),
            'url' => ['/' . \Yii::$app->language . '/url/before']
        ],
        [
            'label' => \Yii::t('guide', 'afterAction'),
            'url' => ['/' . \Yii::$app->language . '/url/after']
        ],
        [
            'label' => \Yii::t('guide', 'URL Helper'),
            'url' => ['/' . \Yii::$app->language . '/url/url-helper']
        ],
//            '<li class="divider"></li>',
//            '<li class="dropdown-header">' . \Yii::t('guide', 'Performance Tuning') . '</li>',
//            [
//                'label' => \Yii::t('guide', 'Performance Tuning'),
//                'url' => ['/' . \Yii::$app->language . '/performance']
//            ],
//            '<li class="divider"></li>',
//            '<li class="dropdown-header">' . \Yii::t('guide', 'Bootstrap widgets') . '</li>',
//            [
//                'label' => \Yii::t('guide', 'Managing assets'),
//                'url' => ['/' . \Yii::$app->language . '/guide/assets']
//            ],
//            '<li class="divider"></li>',
//            '<li class="dropdown-header">' . \Yii::t('guide', 'Bootstrap widgets') . '</li>',
//            '<li class="divider"></li>',
//            '<li class="dropdown-header">' . \Yii::t('guide', 'References') . '</li>',
//            [
//                'label' => \Yii::t('guide', 'Model validation reference'),
//                'url' => ['/' . \Yii::$app->language . '/guide/validation']
//            ],
    ]
    ],
    ['label' => \Yii::t('guide', 'Guide'), 'items' => [
        '<li class="divider"></li>',
        '<li class="dropdown-header">' . \Yii::t('guide', 'Introduction') . '</li>',
        ['label' => \Yii::t('guide', 'What is Yii'), 'url' => ['/' . \Yii::$app->language . '/guide/what-is-yii']],
        '<li class="divider"></li>',
        '<li class="dropdown-header">' . \Yii::t('guide', 'Getting started') . '</li>',
        [
            'label' => \Yii::t('guide', 'Advanced application template'),
            'url' => ['/' . \Yii::$app->language . '/guide/advanced-template']
        ],
        [
            'label' => \Yii::t('guide', 'Configuration'),
            'url' => ['/' . \Yii::$app->language . '/guide/configuration']
        ],
        [
            'label' => \Yii::t('guide', 'Creating your own Application structure'),
            'url' => ['/' . \Yii::$app->language . '/guide/apps-own']
        ],
        [
            'label' => \Yii::t('guide', 'Basic application template'),
            'url' => ['/' . \Yii::$app->language . '/guide/apps-basic']
        ],
        [
            'label' => \Yii::t('guide', 'Installation'),
            'url' => ['/' . \Yii::$app->language . '/guide/installation']
        ],
        [
            'label' => \Yii::t('guide', 'Upgrading from Yii 1.1'),
            'url' => ['/' . \Yii::$app->language . '/guide/upgrade-from-v1']
        ],
        '<li class="divider"></li>',
        '<li class="dropdown-header">' . \Yii::t('guide', 'Base concepts') . '</li>',
        [
            'label' => \Yii::t('guide', 'Basic concepts of Yii'),
            'url' => ['/' . \Yii::$app->language . '/guide/basic-concepts']
        ],
        ['label' => \Yii::t('guide', 'MVC Overview'), 'url' => ['/' . \Yii::$app->language . '/guide/m-v-c']],
        ['label' => \Yii::t('guide', 'Model'), 'url' => ['/' . \Yii::$app->language . '/guide/model']],
        ['label' => \Yii::t('guide', 'View'), 'url' => ['/' . \Yii::$app->language . '/guide/view']],
        ['label' => \Yii::t('guide', 'Controller'), 'url' => ['/' . \Yii::$app->language . '/guide/controller']],
        [
            'label' => \Yii::t('guide', 'Events'),
            'url' => ['/' . \Yii::$app->language . '/events']
        ],
        [
            'label' => \Yii::t('guide', 'Behaviors'),
            'url' => ['/' . \Yii::$app->language . '/behaviors']
        ],
    ]
    ],
    ['label' => \Yii::t('guide', 'Additional topics'), 'items' => [
        '<li class="divider"></li>',
        '<li class="dropdown-header">' . \Yii::t('guide', 'Developers Toolbox') . '</li>',
        [
            'label' => \Yii::t('guide', 'Helper Classes'),
            'url' => ['/' . \Yii::$app->language . '/guide/helper-classes']
        ],
        [
            'label' => \Yii::t('guide', 'Debug toolbar and debugger'),
            'url' => ['/' . \Yii::$app->language . '/guide/module-debug']
        ],
        [
            'label' => \Yii::t('guide', 'The Gii code generation tool'),
            'url' => ['/' . \Yii::$app->language . '/guide/gii']
        ],
        [
            'label' => \Yii::t('guide', 'Error Handling'),
            'url' => ['/' . \Yii::$app->language . '/guide/error-handling']
        ],
        [
            'label' => \Yii::t('guide', 'Logging'),
            'url' => ['/' . \Yii::$app->language . '/logging']
        ],
        '<li class="divider"></li>',
        '<li class="dropdown-header">'
        . \Yii::t('guide', 'Security and access control') .
        '</li>',
        [
            'label' => \Yii::t('guide', 'Authentication'),
            'url' => ['/' . \Yii::$app->language . '/guide/authentication']
        ],
        [
            'label' => \Yii::t('guide', 'Security'),
            'url' => ['/' . \Yii::$app->language . '/security']
        ],
        '<li class="divider"></li>',
        '<li class="dropdown-header">'
        . \Yii::t('guide', 'Authorization') .
        '</li>',
        [
            'label' => 'index - доступен всем',
            'url' => ['/' . \Yii::$app->language . '/authorization']
        ],
        [
            'label' => 'index2 - доступен всем',
            'url' => ['/' . \Yii::$app->language . '/authorization/index2']
        ],
        [
            'label' => 'index3 - доступен только авторизованным',
            'url' => ['/' . \Yii::$app->language . '/authorization/index3']
        ],
        [
            'label' => 'index4 - доступен только авторизованным',
            'url' => ['/' . \Yii::$app->language . '/authorization/index4']
        ],
        [
            'label' => 'index5 - закрыт для всех',
            'url' => ['/' . \Yii::$app->language . '/authorization/index5']
        ],
        [
            'label' => 'index6 - доступен только не авторизованным',
            'url' => ['/' . \Yii::$app->language . '/authorization/index6']
        ],
        [
            'label' => "доступен в зависимости от callback'а",
            'url' => ['/' . \Yii::$app->language . '/authorization/special-callback']
        ],
//            '<li class="divider"></li>',
//            '<li class="dropdown-header">' .
//            \Yii::t('guide', 'Extensions and 3rd party libraries') . '</li>',
//            ['label' => \Yii::t('guide', 'Composer'), 'url' => ['/' . \Yii::$app->language . '/guide/composer']],
//            [
//                'label' => \Yii::t('guide', 'Using 3rd-Party Libraries'),
//                'url' => ['/' . \Yii::$app->language . '/guide/using-3rd-party-libraries']
//            ],
//            ['label' => \Yii::t('guide', 'Extending Yii'), 'url' => ['/' . \Yii::$app->language . '/guide/extending-yii']],
//            [
//                'label' => \Yii::t('guide', 'Using template engines'),
//                'url' => ['/' . \Yii::$app->language . '/guide/using-template-engines']
//            ],
    ]
    ],
    ['label' => \Yii::t('guide', 'RBAC'), 'items' => [
        '<li class="divider"></li>',
        '<li class="dropdown-header">'
        . \Yii::t('guide', 'RBAC') .
        '</li>',
        [
            'label' => 'index - доступен всем',
            'url' => ['/' . \Yii::$app->language . '/rbac']
        ],
        [
            'label' => 'index2 - доступен всем',
            'url' => ['/' . \Yii::$app->language . '/rbac/index2']
        ],
        [
            'label' => 'index3 - доступен только авторизованным',
            'url' => ['/' . \Yii::$app->language . '/rbac/index3']
        ],
        [
            'label' => 'index4 - доступен только авторизованным',
            'url' => ['/' . \Yii::$app->language . '/rbac/index4']
        ],
        [
            'label' => 'index5 - закрыт для всех',
            'url' => ['/' . \Yii::$app->language . '/rbac/index5']
        ],
        [
            'label' => 'index6 - доступен только не авторизованным',
            'url' => ['/' . \Yii::$app->language . '/rbac/index6']
        ],
        [
            'label' => "доступен в зависимости от callback'а",
            'url' => ['/' . \Yii::$app->language . '/rbac/special-callback']
        ],
        [
            'label' => "rbac-auth-user",
            'url' => ['/' . \Yii::$app->language . '/rbac-auth-user/index']
        ],
    ]
    ],
    ['label' => \Yii::t('guide', 'Database and Grids'), 'items' => [
        '<li class="divider"></li>',
        '<li class="dropdown-header">'
        . \Yii::t('guide', 'Data providers, lists and grids') .
        '</li>',
        ['label' => \Yii::t('guide', 'Overview'), 'url' => ['/' . \Yii::$app->language . '/guide/data-overview']],
        [
            'label' => \Yii::t('guide', 'Data providers'),
            'url' => ['/' . \Yii::$app->language . '/guide/data-providers']
        ],
        ['label' => \Yii::t('guide', 'Data widgets'), 'url' => ['/' . \Yii::$app->language . '/guide/data-widgets']],
        ['label' => \Yii::t('guide', 'Grid'), 'url' => ['/' . \Yii::$app->language . '/guide/grid']],
        '<li class="divider"></li>',
        '<li class="dropdown-header">' . \Yii::t('guide', 'Database') . '</li>',
        [
            'label' => \Yii::t('guide', 'Database basics'),
            'url' => ['/' . \Yii::$app->language . '/database-basics']
        ],
        [
            'label' => \Yii::t('guide', 'Query Builder and Query'),
            'url' => ['/' . \Yii::$app->language . '/query-builder']
        ],
        [
            'label' => \Yii::t('guide', 'Active Record'),
            'url' => ['/' . \Yii::$app->language . '/active-record']
        ],
//            [
//                'label' => \Yii::t('guide', 'Database Migration'),
//                'url' => ['/' . \Yii::$app->language . '/guide/database-migration']
//            ],
    ]
    ],
//        ['label' => \Yii::t('guide', 'Contact'), 'url' => ['/' . \Yii::$app->language . '/site/contact']],
//        ['label' => \Yii::t('guide', 'Articles'), 'url' => ['/' . \Yii::$app->language . '/article/index']],
//        ['label' => \Yii::t('guide', 'Articles and tags'), 'url' => ['/' . \Yii::$app->language . '/article-tag/index']],
//        ['label' => \Yii::t('guide', 'Tags'), 'url' => ['/' . \Yii::$app->language . '/tag/index']],
//        ['label' => \Yii::t('guide', 'Categories'), 'url' => ['/' . \Yii::$app->language . '/category/index']],
    ['label' => \Yii::t('guide', 'Gii'), 'url' => ['/' . \Yii::$app->language . '/gii/default/index']],
//        ['label' => 'Frontend', 'url' => 'http://yii2translate.frontend/'],
];
if (Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => 'Login', 'url' => ['/' . \Yii::$app->language . '/site/login']];
} else {
    $menuItems[] = [
        'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
        'url' => ['/' . \Yii::$app->language . '/site/logout']
    ];
}
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => $menuItems,
]);
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-left'],
    'items' => \common\components\MyUrlManager::languages(
            \Yii::$app->getRequest()->getUrl()),
]);
NavBar::end();
?>
<div class="container">
    <div class="row">
        <div class="col-md-3 col-sm-4">
            <?php
            echo Menu::widget([
                'items' => [
                    ['label' => 'Auth Assignment',
                        'items' => [
                            [
                                'label' => 'index',
                                'url' => ['/auth/auth-assignment/index']
                            ],
                            [
                                'label' => 'create',
                                'url' => ['/auth/auth-assignment/create']
                            ],
                        ]
                    ],
                    ['label' => 'Auth Item',
                        'items' => [
                            [
                                'label' => 'index',
                                'url' => ['/auth/auth-item/index']
                            ],
                            [
                                'label' => 'create',
                                'url' => ['/auth/auth-item/create']
                            ],
                        ]
                    ],
                    ['label' => 'Auth Item Child',
                        'items' => [
                            [
                                'label' => 'index',
                                'url' => ['/auth/auth-item-child/index']
                            ],
                            [
                                'label' => 'create',
                                'url' => ['/auth/auth-item-child/create']
                            ],
                        ]
                    ],
                    ['label' => 'Auth Rule',
                        'items' => [
                            [
                                'label' => 'index',
                                'url' => ['/auth/auth-rule/index']
                            ],
                            [
                                'label' => 'create',
                                'url' => ['/auth/auth-rule/create']
                            ],
                        ]
                    ],
                ],
            ]);
            ?>
        </div>
        <div class="col-md-9 col-sm-8">
            <?php
            echo Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ?
                        $this->params['breadcrumbs'] : [],
            ]);
            ?>
            <?php
            //\common\myhelpers\Debugger::debug('');
            ?>
            <?php echo $content; ?>
        </div>
    </div>
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

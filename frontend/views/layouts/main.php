<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;

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
                    ['label' => \Yii::t('guide', 'Theming'), 'url' => ['/guide/theming']],
                    [
                        'label' => \Yii::t('guide', 'Bootstrap widgets'),
                        'url' => ['/guide/bootstrap-widgets']],
                    [
                        'label' => \Yii::t('guide', 'Console applications'),
                        'url' => ['/guide/console']
                    ],
                    [
                        'label' => \Yii::t('guide', 'Working with forms'),
                        'url' => ['/guide/working-with-forms']
                    ],
                    ['label' => \Yii::t('guide', 'Caching'), 'url' => ['/guide/caching']],
                    [
                        'label' => \Yii::t('guide', 'Internationalization'),
                        'url' => ['/guide/internationalization']
                    ],
                    ['label' => \Yii::t('guide', 'URL Management'), 'url' => ['/guide/url']],
                    [
                        'label' => \Yii::t('guide', 'Performance Tuning'),
                        'url' => ['/guide/performance']
                    ],
                    [
                        'label' => \Yii::t('guide', 'Managing assets'),
                        'url' => ['/guide/assets']
                    ],
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
                ['label' => \Yii::t('guide', 'Gii'), 'url' => ['/gii/default/index']],
//                ['label' => 'Backend', 'url' => 'http://yii2translate.backend/'],
//                ['label' => \Yii::t('guide', 'Contact'), 'url' => ['/site/contact']],
//                ['label' => 'Php Info', 'url' => ['/site/php-info']],
			];
			if (Yii::$app->user->isGuest) {
				$menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
				$menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
			} else {
				$menuItems[] = ['label' => 'Logout (' . Yii::$app->user->identity->username .
                    ')' , 'url' => ['/site/logout']];
			}
			echo Nav::widget([
				'options' => ['class' => 'navbar-nav navbar-right'],
				'items' => $menuItems,
			]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-left'],
                'items' => \common\components\MyUrlManager::languages2(),
            ]);
			NavBar::end();
		?>

		<div class="container">
		<?= Breadcrumbs::widget([
			'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
		]) ?>
		<?= Alert::widget() ?>
        <div class="row">
            <?php
//            \common\myhelpers\Debugger::debug(\Yii::$app->components);
//            $article = \common\models\Article::find(1);
//            if ($article) {
//                $attributes = $article->attributes;
//                \common\myhelpers\Debugger::debug($attributes);
//            }
//            $article = new \common\models\Article();
//            $attributes = [
//                'title' => 'Massive assignment example',
//                'text' => 'Never allow assigning attributes that are not meant to be assigned.',
//            ];
//            $article->attributes = $attributes;
//            \common\myhelpers\Debugger::debug($attributes);
            ?>
        </div>
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

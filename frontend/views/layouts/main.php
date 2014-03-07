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
				'brandLabel' => 'My Company',
				'brandUrl' => Yii::$app->homeUrl,
				'options' => [
					'class' => 'navbar-inverse navbar-fixed-top',
				],
			]);
			$menuItems = [
                ['label' => \Yii::t('guide', 'Guide'), 'items' => [
                    ['label' => \Yii::t('guide', 'Advanced application template'), 'url' => ['/guide/advanced-template']],
                    ['label' => \Yii::t('guide', 'Configuration'), 'url' => ['/guide/configuration']],
                    '<li class="divider"></li>',
                    '<li class="dropdown-header">Базовые понятия</li>',
                    ['label' => \Yii::t('guide', 'Basic concepts of Yii'), 'url' => ['/guide/basic-concepts']],
                    ['label' => \Yii::t('guide', 'MVC Overview'), 'url' => ['/guide/m-v-c']],
                    ['label' => \Yii::t('guide', 'Model'), 'url' => ['/guide/model']],
                    ['label' => \Yii::t('guide', 'View'), 'url' => ['/guide/view']],
                    ['label' => \Yii::t('guide', 'Controller'), 'url' => ['/guide/controller']],
                    ['label' => \Yii::t('guide', 'Events'), 'url' => ['/guide/events']],
                    ['label' => \Yii::t('guide', 'Behaviors'), 'url' => ['/guide/behaviors']],
                    '<li class="dropdown-header">Дополнительные темы</li>',
                    ['label' => \Yii::t('guide', 'Testing'), 'url' => ['/guide/testing']],
                    ['label' => \Yii::t('guide', 'Theming'), 'url' => ['/guide/theming']],
                    ['label' => \Yii::t('guide', 'Bootstrap widgets'), 'url' => ['/guide/bootstrap-widgets']],
//                    ['label' => \Yii::t('guide', ''), 'url' => ['/guide/']],
//                    ['label' => \Yii::t('guide', ''), 'url' => ['/guide/']],
//                    ['label' => \Yii::t('guide', ''), 'url' => ['/guide/']],
//                    ['label' => \Yii::t('guide', ''), 'url' => ['/guide/']],
//                    ['label' => \Yii::t('guide', ''), 'url' => ['/guide/']],
//                    ['label' => \Yii::t('guide', ''), 'url' => ['/guide/']],
//                    ['label' => \Yii::t('guide', ''), 'url' => ['/guide/']],
//                    ['label' => \Yii::t('guide', ''), 'url' => ['/guide/']],
//                    ['label' => \Yii::t('guide', ''), 'url' => ['/guide/']],
/*
                    '<li class="dropdown-header"><?php echo \Yii::t("guide", "Base concepts"); ?></li>',
                    '<li class="dropdown-header">\Yii::t("guide", "Base concepts")</li>',
*/
//                    ['label' => 'Теория', 'url' => ['/xml/sax']],
//                    ['label' => 'Пример', 'url' => ['/xml/sax-example']],
//                    '<li class="dropdown-header">DOM</li>',
//                    ['label' => 'Теория', 'url' => ['/xml/dom']],
//                    ['label' => 'Пример', 'url' => ['/xml/dom-example']],
//                    ['label' => 'Пример 2', 'url' => ['/xml/dom-example2']],
//                    '<li class="dropdown-header">SimpleXML</li>',
//                    ['label' => 'Теория', 'url' => ['/xml/simple-xml']],
//                    ['label' => 'Пример', 'url' => ['/xml/simple-xml-example']],
//                    '<li class="dropdown-header">XML и CSS</li>',
//                    ['label' => 'Пример', 'url' => ['/xml/css']],
                ]
                ],
                ['label' => \Yii::t('guide', 'Developers Toolbox'), 'items' => [
                    ['label' => \Yii::t('guide', 'Helper Classes'), 'url' => ['/guide/helper-classes']],
                    ['label' => \Yii::t('guide', 'Debug toolbar and debugger'), 'url' => ['/guide/module-debug']],
                    ['label' => \Yii::t('guide', 'The Gii code generation tool'), 'url' => ['/guide/gii']],
                    ['label' => \Yii::t('guide', 'Error Handling'), 'url' => ['/guide/error-handling']],
                    ['label' => \Yii::t('guide', 'Logging'), 'url' => ['/guide/logging']],
                ]
                ],
                ['label' => \Yii::t('guide', 'Security and access control'), 'items' => [
                    ['label' => \Yii::t('guide', 'Authentication'), 'url' => ['/guide/authentication']],
                    ['label' => \Yii::t('guide', 'Security'), 'url' => ['/guide/security']],
                    ['label' => \Yii::t('guide', 'Authorization'), 'url' => ['/guide/authorization']],
                ]
                ],
                ['label' => \Yii::t('guide', 'Contact'), 'url' => ['/site/contact']],
                ['label' => 'Php Info', 'url' => ['/site/php-info']],
			];
			if (Yii::$app->user->isGuest) {
				$menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
				$menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
			} else {
				$menuItems[] = ['label' => 'Logout (' . Yii::$app->user->identity->username .')' , 'url' => ['/site/logout']];
			}
			echo Nav::widget([
				'options' => ['class' => 'navbar-nav navbar-right'],
				'items' => $menuItems,
			]);
			NavBar::end();
		?>

		<div class="container">
		<?= Breadcrumbs::widget([
			'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
		]) ?>
		<?= Alert::widget() ?>
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

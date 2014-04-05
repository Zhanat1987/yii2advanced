<?php
return [
//    'language' => 'ru-RU',
    'language' => 'ru',
	'components' => [
		'db' => [
			'class' => 'yii\db\Connection',
			'dsn' => 'mysql:host=localhost;dbname=yii2translate',
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		],
		'mail' => [
			'class' => 'yii\swiftmailer\Mailer',
			'viewPath' => '@common/mail',
			'useFileTransport' => true,
		],
        /*
         * https://github.com/yiisoft/yii2/blob/master/docs/guide/url.md
         */
        'urlManager' => [
            'class' => 'common\components\MyUrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'suffix' => '.html',
            'rules' => [
//                '<action:(login|logout|about)>' => 'site/<action>',
//                // ...
//                ['class' => 'app\components\CarUrlRule', 'connectionID' => 'db', ...],

//                '<controller:(post|comment)>/<id:\d+>/<action:(create|updatelete)>' => '<controller>/<action>',
//                '<controller:(post|comment)>/<id:\d+>' => '<controller>/read',
//                '<controller:(post|comment)>s' => '<controller>/list',
                '<language:(ru|en)>/url/index3/<param1>/<param2>' => 'url/index3',
                '<language:(ru|en)>/' => 'site/index',
                '<language:(ru|en)>/<action:(contact|login|logout)>' =>
                    'site/<action>',
                '<language:(ru|en)>/<controller>'=>
                    '<controller>/index',
                '<language:(ru|en)>/<controller:>/<id:\d+>'=>
                    '<controller>/view',
                '<language:(ru|en)>/<controller>/<action>/<id:\d+>'=>
                    '<controller>/<action>',
                '<language:(ru|en)>/<controller>/<action>'=>
                    '<controller>/<action>',
            ],
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                    //'sourceLanguage' => 'en',
                    'fileMap' => [
                        'guide' => 'guide.php',
//                        'app/error' => 'error.php',
                    ],
                ],
            ],
        ],
	],
];

<?php
return [
    'language' => 'ru-RU',
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
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'suffix' => '.html',
            'rules' => [
//                '<action:(login|logout|about)>' => 'site/<action>',
//                // ...
//                ['class' => 'app\components\CarUrlRule', 'connectionID' => 'db', ...],

//                '<controller:(post|comment)>/<id:\d+>/<action:(create|update|delete)>' => '<controller>/<action>',
//                '<controller:(post|comment)>/<id:\d+>' => '<controller>/read',
//                '<controller:(post|comment)>s' => '<controller>/list',
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

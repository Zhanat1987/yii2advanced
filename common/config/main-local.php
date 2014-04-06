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
        'secondDb' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=yii2translate2',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'on afterOpen' => function($event) {
                    $event->sender->createCommand("SET time_zone = 'UTC'")->execute();
                    $sql = 'INSERT INTO `test` VALUES (NULL, "test", "test")';
                    $event->sender->createCommand($sql)->execute();
                }
        ],
        'mail' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            /**
             * true - не отправляет сообщения, а вместо этого создает файлы с
             * расширением eml в директории 'app/runtime/mail'
             */
//            'useFileTransport' => true,
//            'transport' => [
//                'class' => 'Swift_SmtpTransport',
//                'host' => 'localhost',
//                'username' => 'username',
//                'password' => 'password',
//                'port' => '587',
//                'encryption' => 'tls',
//            ],
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'zlodeyzld@gmail.com',
                'password' => 'zlodey87',
                'port' => '465',
                'encryption' => 'ssl'
            ],
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

//                '<controller:(post|comment)>/<id:\d+>/<action:(create|updatelete)>' => 
//                    '<controller>/<action>',
//                '<controller:(post|comment)>/<id:\d+>' => '<controller>/read',
//                '<controller:(post|comment)>s' => '<controller>/list',
                '<language:(ru|en)>/url/index3/<param1>/<param2>' => 'url/index3',
                '<language:(ru|en)>/' => 'site/index',
                '<language:(ru|en)>/<action:(contact|login|logout)>' =>
                    'site/<action>',
                '<language:(ru|en)>/<controller>' =>
                    '<controller>/index',
                '<language:(ru|en)>/<controller:>/<id:\d+>' =>
                    '<controller>/view',
                '<language:(ru|en)>/<controller>/<action>/<id:\d+>' =>
                    '<controller>/<action>',
                '<language:(ru|en)>/<controller>/<action>' =>
                    '<controller>/<action>',
                '<language:(ru|en)>/<module>/<controller>/<action>' =>
                    '<module>/<controller>/<action>',
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

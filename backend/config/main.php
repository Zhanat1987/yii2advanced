<?php
$params = array_merge(
	require(__DIR__ . '/../../common/config/params.php'),
	require(__DIR__ . '/../../common/config/params-local.php'),
	require(__DIR__ . '/params.php'),
	require(__DIR__ . '/params-local.php')
);

return [
	'id' => 'app-backend',
	'basePath' => dirname(__DIR__),
	'preload' => ['log'],
	'controllerNamespace' => 'backend\controllers',
	'modules' => [],
	'components' => [
		'user' => [
			'identityClass' => 'common\models\User',
			'enableAutoLogin' => true,
		],
		'log' => [
			'traceLevel' => YII_DEBUG ? 3 : 0,
			'targets' => [
				[
					'class' => 'yii\log\FileTarget',
					'levels' => ['error', 'warning'],
				],
			],
//            'targets' => [
//                'file' => [
//                    'class' => 'yii\log\FileTarget',
////                    'levels' => ['trace', 'info'],
//                    'levels' => ['info'],
////                    'categories' => ['yii\*'],
//                ],
//                'email' => [
//                    'class' => 'yii\log\EmailTarget',
////                    'levels' => ['error', 'warning'],
//                    'levels' => ['info'],
//                    'message' => [
//                        'to' => [
//                            'iskakov_zhanat@mail.ru',
//                            'asromaroma@mail.ru',
//                        ],
//                        'subject' => 'New ' . $_SERVER['SERVER_NAME'] . ' log message',
//                    ],
//                ],
//                'db' => [
//                    'class' => 'yii\log\DbTarget',
//                    'levels' => ['info'],
////                    'categories' => ['test'],
//                ],
//            ],
        ],
		'errorHandler' => [
			'errorAction' => 'site/error',
		],
        'view' => [
            // темизация
            'theme' => [
                // определяет, где искать файлы представлений
//                'pathMap' => ['@app/views' => '@app/themes/basic'],
                // использование нескольких путей
                'pathMap' => [
                    '@app/views' => [
                        '@app/themes/christmas',
                        '@app/themes/basic'
                    ]
                ],
                // определяет базовый URL для ресурсов,
                // на которые ссылаются из этих файлов
                'baseUrl' => '@app/themes/basic',
            ],
        ],
	],
	'params' => $params,
];

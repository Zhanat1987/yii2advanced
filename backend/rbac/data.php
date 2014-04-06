<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 06.04.14
 * Time: 8:38
 */
use yii\rbac\Item;
use backend\rbac\OnlySecondUser;
use common\myhelpers\Debugger;
use backend\rbac\AuthUser;

$onlySecondUser = new OnlySecondUser;
$authUser = new AuthUser;

return [
    'rules' => [
        /**
         * задаем св-ву 'name' значение равное сериализованному
         * объекту = serialize($onlySecondUser)
         */
        $onlySecondUser->name => serialize($onlySecondUser),
        $authUser->name => serialize($authUser),
    ],
    'items' => [
        // HERE ARE YOUR MANAGEMENT TASKS
        /**
         * опреции - action'ы
         */
        'index' =>
            [
                'type' => Item::TYPE_OPERATION,
                'description' => '...',
                'ruleName' => NULL,
                'data' => NULL
            ],
        'manageThing0' =>
            [
                'type' => Item::TYPE_OPERATION,
                'description' => '...',
                'ruleName' => NULL,
                'data' => NULL
            ],
        'manageThing1' =>
            [
                'type' => Item::TYPE_OPERATION,
                'description' => '...',
                'ruleName' => NULL,
                'data' => NULL
            ],
        'manageThing2' =>
            [
                'type' => Item::TYPE_OPERATION,
                'description' => '...',
                'ruleName' => NULL,
                'data' => NULL
            ],
        'manageThing3' =>
            [
                'type' => Item::TYPE_OPERATION,
                'description' => '...',
                'ruleName' => NULL,
                'data' => NULL
            ],
        /**
         * задачи - controller'ы
         */
        'rbac-all' =>
            [
                'type' => Item::TYPE_TASK,
                'description' => 'Доступ к контроллеру Rbac',
                'ruleName' => $onlySecondUser->name,
                'data' => NULL
            ],
        // AND THE ROLES
        /**
         * роли - значение поля rbac в модели \common\models\User
         */
        'guest' => [
            'type' => Item::TYPE_ROLE,
            'description' => 'Guest',
            'ruleName' => NULL,
            'data' => NULL
        ],

        'user' => [
            'type' => Item::TYPE_ROLE,
            'description' => 'User',
            'children' => [
                'guest',
                'rbac-all',
                'manageThing0', // User can edit thing0
            ],
//            'ruleName' => 'return !Yii::$app->user->isGuest;',
            'ruleName' => $authUser->name,
            'data' => NULL
        ],

        'moderator' => [
            'type' => Item::TYPE_ROLE,
            'description' => 'Moderator',
            'children' => [
                'user', // Can manage all that user can
                'manageThing1', // and also thing1
            ],
            'ruleName' => NULL,
            'data' => NULL
        ],

        'admin' => [
            'type' => Item::TYPE_ROLE,
            'description' => 'Admin',
            'children' => [
                'moderator', // can do all the stuff that moderator can
                'manageThing2', // and also manage thing2
            ],
            'ruleName' => NULL,
            'data' => NULL
        ],

        'godmode' => [
            'type' => Item::TYPE_ROLE,
            'description' => 'Super admin',
            'children' => [
                'admin', // can do all that admin can
                'manageThing3', // and also thing3
            ],
            'ruleName' => NULL,
            'data' => NULL
        ],
    ],
];
<?php
/**OnlySecondUser
 * Created by PhpStorm.
 * User: admin
 * Date: 06.04.14
 * Time: 10:52
 */

namespace backend\rbac;

use yii\rbac\Rule;

class AuthUser extends Rule
{

    public function execute($params, $data)
    {
        return !\Yii::$app->user->isGuest;
    }

}
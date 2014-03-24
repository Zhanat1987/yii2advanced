<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 17.03.14
 * Time: 20:05
 */

namespace backend\models;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Article extends \common\models\Article
{

    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            return true;
        } else {
            return false;
        }
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            return true;
        } else {
            return false;
        }
    }

    public function getAuthor()
    {
        return [
            \Yii::$app->user->id => \Yii::$app->user->identity->username
        ];
    }

    public function behaviors()
    {
        return [
            /*
             * https://github.com/yiisoft/yii2/blob/master/docs/guide/behaviors.md
             * https://github.com/yiisoft/yii2/issues/429
             */
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'value' => new Expression('NOW()'),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at',
                ],
            ],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['cat_id', 'title', 'text', 'author', 'status', 'img'];
        return $scenarios;
    }

} 
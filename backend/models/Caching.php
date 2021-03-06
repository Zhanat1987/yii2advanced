<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "caching".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 */
class Caching extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'caching';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
        ];
    }

    public function getAll()
    {
        if (($models = unserialize(Yii::$app->cache->get('allCaching'))) === false) {
            $models = self::find()->asArray()->select('id, title')->all();
            Yii::$app->cache->set('allCaching', serialize($models), 3600);
        }
        return $models;
    }

}

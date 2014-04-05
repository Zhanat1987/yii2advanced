<?php

namespace backend\models;

use Yii;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;
use common\myhelpers\Debugger;
use backend\behaviors\MyBehavior;

/**
 * This is the model class for table "behaviors".
 *
 * @property integer $id
 * @property string $title
 * @property integer $creation_time
 * @property integer $update_time
 * @property integer $author_id
 * @property integer $updater_id
 * @property string $attribute1
 * @property string $attribute2
 * @property string $insert
 * @property string $update
 */
class Behaviors extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'behaviors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['creation_time', 'update_time', 'author_id', 'updater_id'],
                'integer'],
            [['title'], 'string', 'max' => 100],
            [['attribute1', 'attribute2', 'insert', 'update'],
                'string', 'max' => 255]
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
            'creation_time' => 'Creation Time',
            'update_time' => 'Update Time',
            'author_id' => 'Author ID',
            'updater_id' => 'Updater ID',
            'attribute1' => 'Attribute1',
            'attribute2' => 'Attribute2',
            'insert' => 'Insert',
            'update' => 'Update',
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'creation_time',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'update_time',
                ],
//                'value' => new Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'author_id',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updater_id',
                ],
            ],
            'attributeStamp' => [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'attribute1',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'attribute2',
                ],
                /**
                 * $event - Object of class yii\base\ModelEvent
                 */
                'value' => function ($event) {
                        /**
                         * $event->sender - это объект текущего класса,
                         * который использует это поведение и вызывает
                         * текущее событие, т.е. в данном случае - это
                         * экземпляр модели - backend\models\Behaviors =>
                         * от него можно получить все значения атрибутов
                         * и т.д.
                         */
//                    return 'some value';
                        $value = <<<ModelEvent
name - $event->name, data - $event->data,
ModelEvent;
//                        Debugger::stop($value);
//                        Debugger::stop($event);
                        return $value;
                    },
            ],
            'myBehavior' => [
                'class' => MyBehavior::className(),
                'insertAttribute' => 'insert',
                'updateAttribute' => 'update',
            ],
        ];
    }

}

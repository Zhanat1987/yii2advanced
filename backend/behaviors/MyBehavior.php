<?php
/**
 * Created by PhpStorm.
 * User: zhanat
 * Date: 05.04.14
 * Time: 10:53
 */

namespace backend\behaviors;

use yii\base\Behavior;
use yii\db\ActiveRecord;
use common\myhelpers\Debugger;

class MyBehavior extends Behavior
{
    public $insertAttribute;
    public $updateAttribute;

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'beforeInsert',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'beforeUpdate',
        ];
    }

    /*
     * привести к целому числу и возвести в квадрат
     */
    public function beforeInsert()
    {
        $model = $this->owner;
        // Use $model->$attr
//        Debugger::stop($this->insertAttribute);
//        Debugger::stop($model);
        $model->{$this->insertAttribute} =
            (int) $model->{$this->insertAttribute};
        $model->{$this->insertAttribute} =
            pow($model->{$this->insertAttribute}, 2);
    }

    /**
     * если квадратный корень из значения атрибута
     * является целым числом, то изменить, иначе нет
     */
    public function beforeUpdate()
    {
        $model = $this->owner;
        // Use $model->$attr
//        Debugger::stop($model->{$this->updateAttribute});
        $sqrt = sqrt((float) $model->{$this->updateAttribute}) * 1;
//        Debugger::debug(is_int($sqrt));
//        Debugger::debug($sqrt);
        $model->{$this->updateAttribute} =
            strpos($sqrt, '.') === false ?
                $sqrt : $model->{$this->updateAttribute};
        $model->{$this->updateAttribute} =
            (string) $model->{$this->updateAttribute};
//        Debugger::stop((string) $model->{$this->updateAttribute});
    }
}
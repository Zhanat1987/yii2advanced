<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 17.03.14
 * Time: 20:05
 */

namespace backend\models;


class Category extends \common\models\Category
{

    public function beforeValidate()
    {
        parent::beforeValidate();
        // FIXME: TODO: WIP, TBD
//        if ($this->isNewRecord && empty($this->parent_id)) {
//            $this->materialized_path = '';
//            $this->parent_id = 0;
//        }
    }

    public function getAllForDropdownList($id)
    {
        if ($id) {
            $models = $this->find()->asArray()->select(['id', 'title'])->where('id != ' . $id)->all();
        } else {
            $models = $this->find()->asArray()->select(['id', 'title'])->all();
        }
        $data = [
            null => 'Выберите родительскую категорию',
        ];
        if ($models) {
            foreach ($models as $model) {
                $data[$model['id']] = $model['title'];
            }
        }
        return $data;
    }

} 
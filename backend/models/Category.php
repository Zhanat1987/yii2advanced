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
        if (parent::beforeValidate()) {
            // FIXME: TODO: WIP, TBD
            if (!empty($this->parent_id)) {
                $this->parent_id = (int) $this->parent_id;
            }
            return true;
        } else {
            return false;
        }
    }

    public function getAllForDropdownList($id = null)
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

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // ...custom code here...
            if (!empty($this->parent_id)) {
                $model = $this->find()->asArray()->select(['materialized_path'])->where(
                    'id = ' . $this->parent_id)->one();
                $parentMP = !empty($model['materialized_path']) ?
                    $model['materialized_path'] . '.' : '';
                $this->materialized_path = $parentMP . $this->parent_id;
            }
            return true;
        } else {
            return false;
        }
    }

} 
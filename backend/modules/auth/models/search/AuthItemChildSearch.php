<?php

namespace backend\modules\auth\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\auth\models\AuthItemChild;

/**
 * AuthItemChildSearch represents the model behind the search form about `backend\modules\auth\models\AuthItemChild`.
 */
class AuthItemChildSearch extends AuthItemChild
{
    public function rules()
    {
        return [
            [['parent', 'child'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = AuthItemChild::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'parent', $this->parent])
            ->andFilterWhere(['like', 'child', $this->child]);

        return $dataProvider;
    }
}

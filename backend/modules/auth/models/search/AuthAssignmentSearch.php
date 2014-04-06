<?php

namespace backend\modules\auth\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\auth\models\AuthAssignment;

/**
 * AuthAssignmentSearch represents the model behind the search form about `backend\modules\auth\models\AuthAssignment`.
 */
class AuthAssignmentSearch extends AuthAssignment
{
    public function rules()
    {
        return [
            [['item_name', 'user_id', 'rule_name', 'data'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = AuthAssignment::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'item_name', $this->item_name])
            ->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'rule_name', $this->rule_name])
            ->andFilterWhere(['like', 'data', $this->data]);

        return $dataProvider;
    }
}

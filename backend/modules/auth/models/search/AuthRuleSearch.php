<?php

namespace backend\modules\auth\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\auth\models\AuthRule;

/**
 * AuthRuleSearch represents the model behind the search form about `backend\modules\auth\models\AuthRule`.
 */
class AuthRuleSearch extends AuthRule
{
    public function rules()
    {
        return [
            [['name', 'data'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = AuthRule::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'data', $this->data]);

        return $dataProvider;
    }
}

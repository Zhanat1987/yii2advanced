<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ArticleTag;

/**
 * ArticleTagSearch represents the model behind the search form about `common\models\ArticleTag`.
 */
class ArticleTagSearch extends Model
{
	public $id;
	public $article_id;
	public $tag_id;

	public function rules()
	{
		return [
			[['id', 'article_id', 'tag_id'], 'integer'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'article_id' => 'ID статьи',
			'tag_id' => 'ID тега',
		];
	}

	public function search($params)
	{
		$query = ArticleTag::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$this->addCondition($query, 'id');
		$this->addCondition($query, 'article_id');
		$this->addCondition($query, 'tag_id');
		return $dataProvider;
	}

	protected function addCondition($query, $attribute, $partialMatch = false)
	{
		if (($pos = strrpos($attribute, '.')) !== false) {
			$modelAttribute = substr($attribute, $pos + 1);
		} else {
			$modelAttribute = $attribute;
		}

		$value = $this->$modelAttribute;
		if (trim($value) === '') {
			return;
		}
		if ($partialMatch) {
			$query->andWhere(['like', $attribute, $value]);
		} else {
			$query->andWhere([$attribute => $value]);
		}
	}
}

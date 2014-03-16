<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Category;

/**
 * CategorySearch represents the model behind the search form about `common\models\Category`.
 */
class CategorySearch extends Model
{
	public $id;
	public $parent_id;
	public $materialized_path;
	public $title;
	public $description;

	public function rules()
	{
		return [
			[['id', 'parent_id'], 'integer'],
			[['materialized_path', 'title', 'description'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'parent_id' => 'ID родительской категории',
			'materialized_path' => 'материализованный путь категории',
			'title' => 'заголовок',
			'description' => 'описание',
		];
	}

	public function search($params)
	{
		$query = Category::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$this->addCondition($query, 'id');
		$this->addCondition($query, 'parent_id');
		$this->addCondition($query, 'materialized_path', true);
		$this->addCondition($query, 'title', true);
		$this->addCondition($query, 'description', true);
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

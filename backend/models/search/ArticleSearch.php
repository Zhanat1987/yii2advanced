<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Article;

/**
 * ArticleSearch represents the model behind the search form about `common\models\Article`.
 */
class ArticleSearch extends Model
{
	public $id;
	public $cat_id;
	public $title;
	public $text;
	public $img;
	public $status;
	public $views;
	public $author;
	public $created_at;
	public $updated_at;

	public function rules()
	{
		return [
			[['id', 'cat_id', 'status', 'views', 'author'], 'integer'],
			[['title', 'text', 'img', 'created_at', 'updated_at'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'cat_id' => 'ID категории',
			'title' => 'заголовок',
			'text' => 'текст',
			'img' => 'изображение',
			'status' => 'статус',
			'views' => 'просмотры',
			'author' => 'автор',
			'created_at' => 'дата создания',
			'updated_at' => 'дата редактирования',
		];
	}

	public function search($params)
	{
		$query = Article::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$this->addCondition($query, 'id');
		$this->addCondition($query, 'cat_id');
		$this->addCondition($query, 'title', true);
		$this->addCondition($query, 'text', true);
		$this->addCondition($query, 'img', true);
		$this->addCondition($query, 'status');
		$this->addCondition($query, 'views');
		$this->addCondition($query, 'author');
		$this->addCondition($query, 'created_at');
		$this->addCondition($query, 'updated_at');
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

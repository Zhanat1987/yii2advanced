<?php

namespace common\models;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property integer $cat_id
 * @property string $title
 * @property string $text
 * @property string $img
 * @property integer $status
 * @property integer $views
 * @property integer $author
 * @property string $created_at
 * @property string $updated_at
 *
 * @property ArticleTag[] $articleTags
 */
class Article extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'article';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['cat_id', 'title', 'text', 'author', 'created_at'], 'required'],
			[['cat_id', 'status', 'views', 'author'], 'integer'],
			[['text'], 'string'],
			[['created_at', 'updated_at'], 'safe'],
			[['title'], 'string', 'max' => 255],
			[['img'], 'string', 'max' => 4],
			[['title'], 'unique']
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

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getArticleTags()
	{
		return $this->hasMany(ArticleTag::className(), ['article_id' => 'id']);
	}
}

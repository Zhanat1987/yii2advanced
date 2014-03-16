<?php

namespace common\models;

/**
 * This is the model class for table "tag".
 *
 * @property integer $id
 * @property string $title
 *
 * @property ArticleTag[] $articleTags
 */
class Tag extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'tag';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['title'], 'required'],
			[['title'], 'string', 'max' => 255],
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
			'title' => 'Title',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getArticleTags()
	{
		return $this->hasMany(ArticleTag::className(), ['tag_id' => 'id']);
	}
}

<?php

namespace common\models;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $materialized_path
 * @property string $title
 * @property string $description
 *
 * @property Category $parent
 * @property Category[] $categories
 */
class Category extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'category';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['parent_id'], 'integer'],
			[['materialized_path', 'title'], 'required'],
			[['materialized_path', 'description'], 'string', 'max' => 255],
			[['title'], 'string', 'max' => 100],
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
			'parent_id' => 'ID родительской категории',
			'materialized_path' => 'материализованный путь категории',
			'title' => 'заголовок',
			'description' => 'описание',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getParent()
	{
		return $this->hasOne(Category::className(), ['id' => 'parent_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCategories()
	{
		return $this->hasMany(Category::className(), ['parent_id' => 'id']);
	}
}

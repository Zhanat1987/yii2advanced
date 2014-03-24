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

    public static $status = [
        0 => 'not published',
        1 => 'published',
        2 => 'deleted'
    ];

    public $birthDate;

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
			[['cat_id', 'title', 'text', 'author', 'status'], 'required'],
			[['cat_id', 'status', 'views', 'author'], 'integer'],
			[['text'], 'string'],
			[['created_at', 'updated_at'], 'safe'],
			[['title'], 'string', 'max' => 255],
//			[['img'], 'file', 'on' => ['create'],
//                'types' => 'jpg, jpeg, png, gif',
//                'minSize' => 1048576,
//                'maxSize' => 10485760,
//                'maxFiles' => 1,
//                'message' => 'ошибка при загрузке файла',
//                'uploadRequired' => 'файл необходимо загрузить',
//                'tooBig' => 'файл не может превышать {limit}',
//                'tooSmall' => 'атрибут - {attribute}, имя файла - {file}, меньше чем - {limit}',
//                'wrongType' => 'не верный формат файла, необходимо загрузить - {extensions}',
//                'tooMany' => 'количество загружаемых файлов не должно превышать - {limit}',
//                'skipOnEmpty' => true // не валидировать при пустом значении
//            ],
            [['img'], 'image', 'mimeTypes' => 'image/jpeg, image/png'],
            [['birthDate'], 'validateAge', 'params' => ['min' => 10, 'max' => 1000]],
            [['title'], 'unique']
		];
	}

    public function validateAge($attribute, $params)
    {
        $value = $this->$attribute;
        if ($value < $params['min'] || $value > $params['max']) {
            $this->addError($attribute, 'Не правильно указан возраст!!!');
        }
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

    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            return true;
        } else {
            return false;
        }
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            return true;
        } else {
            return false;
        }
    }

    public function scenarios()
    {
        return parent::scenarios();
    }

}

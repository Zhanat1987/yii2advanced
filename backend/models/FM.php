<?php
/**
 * Created by PhpStorm.
 * User: zhanat
 * Date: 29.03.14
 * Time: 12:22
 */

namespace backend\models;
use yii\base\Model;

class FM extends Model
{
    public $text,
        $password,
        $repeatPassword,
        $textarea,
        $editor,
        $integer,
        $integerRange,
        $radio,
        $checkbox,
        $notIn,
        $select,
        $multiSelect,
        $select2,
        $multiSelect2,
        $file,
        $image,
        $boolean,
        $booleanStrict,
        $date,
        $time,
        $datetime,
        $phone,
        $regExp,
        $mask,
        $birthDate,
        $classValidate,
        $compareValue,
        $email;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [
                [
                    'text',
                    'password',
                    'repeatPassword',
                    'textarea',
                    'editor',
                    'integer',
                    'integerRange',
                    'radio',
                    'checkbox',
                    'notIn',
                    'select',
                    'multiSelect',
                    'select2',
                    'multiSelect2',
                    'file',
                    'image',
                    'boolean',
                    'booleanStrict',
                    'date',
                    'time',
                    'datetime',
                    'phone',
                    'regExp',
                    'mask',
                    'birthDate',
                    'classValidate',
                    'compareValue',
                    'email',
                ],
                'required'],
            ['text', 'string', 'min' => 5, 'max' => 10],
            [
                'repeatPassword', 'compare',
                'compareAttribute' => 'password',
                'operator' => '===',
            ],
            [
                'compareValue', 'compare',
                'compareValue' => 'test',
            ],
            ['email', 'email'],
            ['date', 'date', 'format' => 'Y-m-d'],
            ['datetime', 'date', 'format' => 'Y-m-d H:i:s'],
            ['integer', 'integer'],
            ['integerRange', 'integer', 'min' => 1, 'max' => 100],
            ['boolean', 'boolean'],
            [
                'booleanStrict', 'boolean',
                'strict' => true,
                'trueValue' => '1',
                'falseValue' => '0',
            ],
            ['radio', 'in', 'range' => [0, 1, 2]],
            [
                'checkbox', 'in',
                'range' => [0, 1, 2],
                'strict' => true,
            ],
            [
                'notIn', 'in',
                'range' => ['0', '1', '2'],
                'not' => true,
            ],
			[['file'], 'file',
                'types' => 'php, js, css',
                'minSize' => 1048576,
                'maxSize' => 10485760,
                'maxFiles' => 1,
                'message' => 'ошибка при загрузке файла',
                'uploadRequired' => 'файл необходимо загрузить',
                'tooBig' => 'файл не может превышать {limit}',
                'tooSmall' => 'атрибут - {attribute}, имя файла - {file}, меньше чем - {limit}',
                'wrongType' => 'не верный формат файла, необходимо загрузить - {extensions}',
                'tooMany' => 'количество загружаемых файлов не должно превышать - {limit}',
                'skipOnEmpty' => true // не валидировать при пустом значении
            ],
            [['image'], 'image', 'mimeTypes' => 'image/jpeg, image/png'],
            [['birthDate'], 'validateAge', 'params' => ['min' => 10, 'max' => 1000]],
            /**
             * фильтры
             */
        ];
    }

    public function attributeLabels()
    {
        return [
            'text' => 'Имя',
            'password' => 'Пароль',
            'repeatPassword' => 'Повторите пароль',
            'email' => 'E-mail',
            'compareValue' => 'Сравнить с заданным значением',
            'textarea' => 'Текстовая область',
            'editor' => 'Редактор',
            'date' => 'Дата',
            'time' => 'Время',
            'datetime' => 'Дата и время',
            'integer' => 'Целое число',
            'integerRange' => 'Целое число в дипозоне от 1 и до 100',
            'boolean' => 'Булево значение',
            'booleanStrict' => 'Булево значение со строгим сравнением',
            'radio' => 'Радио',
            'checkbox' => 'Чекбокс',
            'notIn' => 'NOT IN',
            'select' => 'select',
            'multiSelect' => 'multiSelect',
            'select2' => 'select2',
            'multiSelect2' => 'multiSelect2',
            'file' => 'Файл (php, js, css)',
            'image' => 'Изображение (jpeg, png)',
            'birthDate' => 'Дата рождения',
        ];
    }

    public function getList($count = 10)
    {
        $data = [];
        for ($i = 0; $i < $count; ++$i) {
            $data[$i] = \common\myhelpers\String::random();
        }
        return $data;
    }

    public function validateAge($attribute, $params)
    {
        $value = $this->$attribute;
        if ($value < $params['min'] || $value > $params['max']) {
            $this->addError($attribute, 'Не правильно указан возраст!!!');
        }
    }

} 
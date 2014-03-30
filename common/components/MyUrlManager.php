<?php
/**
 * Created by PhpStorm.
 * User: zhanat
 * Date: 30.03.14
 * Time: 15:29
 */

namespace common\components;

use yii\web\UrlManager;

/**
 * Class MyUrlManager
 * @package common\components
 * http://www.elisdn.ru/blog/39/yii-based-multilanguage-site-interface-and-urls
 */
class MyUrlManager extends UrlManager
{

    public function createUrl($route, $params=array(), $ampersand='&')
    {
        if (empty($params['language'])) {
            $params['language'] = \Yii::$app->language;
        }
        return parent::createUrl($route, $params, $ampersand);
    }

    /**
     * @return array
     * если перевод есть для всех страниц
     */
    public static function languages($url)
    {
        $languages = [];
        $langs = ['ru', 'en'];
        foreach ($langs as $lang) {
            if ($lang == \Yii::$app->language) {
                $languages[] = [
                    'label' => $lang,
                    'options' => [
                        'class' => 'returnFalse',
                    ],
                ];
            } else {
                $languages[] = [
                    'label' => $lang,
                    'url' => [str_replace(\Yii::$app->language, $lang, $url)]
                ];
            }
        }
        return $languages;
    }

    /**
     * @return array
     * если нет перевода всех страниц
     */
    public static function languages2()
    {
        $languages = [];
        $langs = ['ru', 'en'];
        foreach ($langs as $lang) {
            if ($lang == \Yii::$app->language) {
                $languages[] = [
                    'label' => $lang,
                    'options' => [
                        'class' => 'returnFalse',
                    ],
                ];
            } else {
                $languages[] = [
                    'label' => $lang,
                    'url' => ['/' . $lang]
                ];
            }
        }
        return $languages;
    }

} 
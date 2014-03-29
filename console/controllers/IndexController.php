<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

/**
 * Index controller
 */
class IndexController extends Controller
{

    public $option1, $option2, $test;

    /**
     * php yii index
     * php yii index/index
     */
    public function actionIndex()
	{
		echo 1 . "\n\r";
	}

    /**
     * php yii index/params param1Value
     * php yii index/params param1Value param2Value
     */
    public function actionParams($param1, $param2 = 'test')
    {
        echo "param1 - $param1\n\rparam2 - $param2\n\r";
    }

    /**
     * php yii index/params-with-array param1Value
     * php yii index/params-with-array param1Value param2Value
     * php yii index/params-with-array param1Value param2Value v1,v2,k3=v3
     */
    public function actionParamsWithArray($param1, $param2 = 'test', array $data = [])
    {
        echo "param1 - $param1\n\rparam2 - $param2\n\r";
        if ($data) {
            echo "data:\n\r";
            foreach ($data as $k => $v) {
                echo "key - $k, value - $v\n\r";
            }
        }
    }

    /**
     * php yii index/yii-options --color=green
     * так можно передавать глобальные опции yii, которые указаны как public свойства в
     * \yii\console\Controller'е и перечислены в его методе 'options($id)'
     */
    public function actionYiiOptions()
    {
        echo "color - $this->color\n\r";
    }

    /**
     * @param string $id
     * @return array
     * создадим свои public свойства и перечислим их в этом методе, тем самым
     * переопределив родительский метод
     */
    public function options($id)
    {
        // $id might be used in subclass to provide options specific to action id
        return array_merge(['option1', 'option2', 'test'],
            parent::options($id));
    }

    /**
     * php yii index/my-options --option1=option1Value --option2=option2Value --color=green
     */
    public function actionMyOptions()
    {
        echo "option1 - $this->option1\n\roption2 - $this->option2\n\rcolor - $this->color\n\r";
    }

    /**
     * php yii index/all-options
     */
    public function actionAllOptions()
    {
        var_dump($this->options('index'));
    }

}

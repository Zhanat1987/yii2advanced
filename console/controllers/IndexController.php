<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

/**
 * Index controller
 */
class IndexController extends Controller
{

    public $option1, $option2;

    /**
     * php yii index
     * php yii index/index
     */
    public function actionIndex()
	{
		echo 1;
	}

    /**
     * php yii index/params param1Value
     * php yii index/params param1Value param2Value
     */
    public function actionParams($param1, $param2 = 'test')
    {
        echo "param1 - $param1\n\rparam2 - $param2";
    }

    /**
     * php yii index/yii-options --color=green
     * так можно передавать глобальные опции yii, которые указаны как public свойства в
     * \yii\console\Controller'е и перечислены в его методе 'options($id)'
     */
    public function actionYiiOptions()
    {
        echo "color - $this->color";
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
        return array_merge(['option1', 'option2'], parent::options($id));
    }

    /**
     * php yii index/my-options --option1=option1Value --option2=option2Value --color=green
     */
    public function actionMyOptions()
    {
        echo "option1 - $this->option1\n\roption2 - $this->option2\n\rcolor - $this->color";
    }

}

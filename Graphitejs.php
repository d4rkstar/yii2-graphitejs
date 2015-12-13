<?php
/**
 * Created by PhpStorm.
 * User: brunosalzano
 * Date: 13/12/15
 * Time: 23:04
 */

namespace d4rkstar\graphitejs;


use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\JsExpression;
use yii\web\View;

/**
 * This class will provide aGraphitejs widget to Yii2 projects
 *
 * @package d4rkstar\graphitejs
 */
class Graphitejs extends Widget {

    /**
     * @var array HTML attributes or other settings for widgets
     */
    public $options = [];

    /**
     * @var array widget plugin options
     */
    public $pluginOptions = [];

    public $defaultUrl = null;

    public $width = "450";

    public $height = "300";

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->registerAssets();

    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $this->initOptions();

        $options = Json::encode($this->pluginOptions);
        if ($this->defaultUrl!=null) {
            $defaultUrl = "$.fn.graphite.defaults.url=\"{$this->defaultUrl}\";\n";
        }

        $js = new JsExpression($defaultUrl.'jQuery("#'.$this->options['id'].'").graphite('.$options.');');


        $view = $this->getView();
        $view->registerJs($js, View::POS_END);

        return Html::tag("img","",['id'=>$this->options['id']]);


    }

    /**
     * Initializes the widget options.
     * This method sets the default values for various options.
     */
    protected function initOptions()
    {
        if (empty($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }
    }

    /**
     * Register assets
     */
    protected function registerAssets()
    {
        $view = $this->getView();
        GraphitejsAsset::register($view);

    }
}

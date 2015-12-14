<?php
namespace d4rkstar\graphitejs;

use yii\base\Widget;
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

    /**
     * @var string url for the graphite render service
     */
    public $defaultUrl = null;

    /**
     * @var int graph width
     */
    public $width = null;

    /**
     * @var int graph height
     */
    public $height = null;

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
        $defaults = [];
        if ($this->defaultUrl!=null) {
            $defaults[] = "$.fn.graphite.defaults.url=\"{$this->defaultUrl}\";\n";
        }

        if ($this->width!=null) {
            $defaults[] = "$.fn.graphite.defaults.url=\"{$this->width}\";\n";
        }

        if ($this->height!=null) {
            $defaults[] = "$.fn.graphite.defaults.width=\"{$this->height}\";\n";
        }
        $defaults = implode("\n",$defaults)."\n";
        $js = new JsExpression($defaults.'jQuery("#'.$this->options['id'].'").graphite('.$options.');');


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

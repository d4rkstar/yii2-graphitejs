<?php
/**
 * Created by PhpStorm.
 * User: brunosalzano
 * Date: 13/12/15
 * Time: 23:09
 */
namespace d4rkstar\graphitejs;

use yii\web\AssetBundle;

class GraphitejsAsset extends AssetBundle {

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];


    /**
     * @inheritdoc
     */
    public function init() {
        parent::init();
        $this->js = [];
        $this->css = [];
        $this->sourcePath = __DIR__ . '/assets';
        $this->setupAssets('js', ['js/graphite']);
        parent::init();
    }

    /**
     * Set up CSS and JS asset arrays based on the base-file names
     *
     * @param string $type whether 'css' or 'js'
     * @param array $files the list of 'css' or 'js' basefile names
     */
    protected function setupAssets($type, $files = []) {

        $srcFiles = [];
        $minFiles = [];
        foreach ($files as $file) {
            $srcFiles[] = "{$file}.{$type}";
            $minFiles[] = "{$file}.min.{$type}";
        }
        $this->$type = YII_DEBUG ? $srcFiles : $minFiles;

    }

}
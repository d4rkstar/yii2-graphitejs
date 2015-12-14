## yii2-graphitejs

This widget is a wrapper around [GraphiteJS](https://github.com/prestontimmons/graphitejs) Jquery plugin.

GraphiteJS Plugin allow to easily make graphs and update them on the fly using 
[Graphite's Render Url API](http://graphite.readthedocs.org/en/latest/render_api.html).

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/). 

### Install

Either run

```
$ php composer.phar require d4rkstar/yii2-graphitejs "dev-master"
```

or add

```
"d4rkstar/yii2-graphitejs": "dev-master"
```

to the ```require``` section of your `composer.json` file.

### Sample Usage

```
<?php
use d4rkstar\graphitejs\Graphitejs;
?>

... 

<?= Graphitejs::widget([
        'options' => [
            'id'=>'serverLoadGraph',
        ],
        'pluginOptions'=>[
            'url'=>'http://localhost/render/',
            'from'=>'-24hours',
           // replace with your targets
           'target'=>[
               'server.load.load1', 
               'server.load.load5',
               'server.load.load15'
            ],
            'width'=>300,
            'height'=>300,
        ]
]);

?>
```

For more usage, look at GraphiteJS examples and Graphite's Render Url API.
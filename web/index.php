<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

if( isset($_POST['KeywordInput']['keyWord']) and !empty($_POST['KeywordInput']['keyWord'])){
    $_SERVER['argv'] =  [
        __DIR__.'/../yii',
//        '~/home/dev/www/projectFolder/yii',
        'pars'//$_GET['r']//$_POST['KeywordInput']['asdsd']
    ];
    $_SERVER['argc'] = 2;
    $config = require(__DIR__ . '/../config/console.php');
    $application = new yii\console\Application($config);
    $exitCode = $application->run();
//    var_dump($exitCode['id']);
    exit;
    unset($_GET['r']);
    header('Location: http://inst/');

}
(new yii\web\Application($config))->run();

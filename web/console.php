#!/usr/bin/env php
<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/console.php');

// ЗДЕСЬ!!! Вставленный нами код
if( isset($_GET['r']) and !empty($_GET['r'])){
    $_SERVER['argv'] =  [
        __DIR__.'/../yii',
//        '~/home/dev/www/projectFolder/yii',
        $_GET['r']
    ];
    $_SERVER['argc'] = 2;
}

$application = new yii\console\Application($config);
$exitCode = $application->run();
exit($exitCode);
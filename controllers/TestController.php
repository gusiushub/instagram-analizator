<?php


namespace app\controllers;

use app\models\AuthInst;
use Yii;
use yii\web\Controller;

class TestController extends Controller
{
    public function actionT()
    {
        echo 1;exit;
        $model = new AuthInst();
//        $model->auth();
        $model->request();
        sleep(5);
        $page = $model->action('https://www.instagram.com/explore/tags/stackoverflow/');
//        $obj = json_decode($page,true);
        var_dump($page);
    }
}
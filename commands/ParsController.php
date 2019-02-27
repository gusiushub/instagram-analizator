<?php
namespace app\commands;

use app\models\AuthInst;
use app\models\Instagram;
use DOMDocument;
use GuzzleHttp\Client;
use yii\console\Controller;
use yii\console\ExitCode;

class ParsController extends Controller
{

    public function actionIndex()
    {
//        return $this->render('index', [
//            'model' => $model,
//            'info' => Instagram::getInfo('yandex'),
//        ]);
//        exit;
        $a = 'asdasd1';
//        echo 1;

//        echo $_POST['KeywordInput']['keyWord'];
//        return $_GET['r'].'sdfsdf';

        $model = new AuthInst();
        $model->request();
        sleep(1);
        $page = $model->action('https://www.instagram.com/graphql/query/?query_hash=f92f56d47dc7a55b606908374b43a314&variables=%7B%22tag_name%22%3A%22yandex%22%2C%22show_ranked%22%3Afalse%2C%22first%22%3A30%2C%22after%22%3A%22QVFDeVM1VzVJQzJoQzlXWEhDdy1OUTNjUm54SzhfdUgxVnAwbWx2YXluSjZNaHl4OUh5VVdQUU4ycUhSTU5sNUJIVlptVG1JSUdCeTU0SE5vZGlfZlpLTA%3D%3D%22%7D');
//        $page = $model->action('https://www.instagram.com/graphql/query/?query_hash=f92f56d47dc7a55b606908374b43a314&variables=%7B%22tag_name%22%3A%22'.$_POST['KeywordInput']['keyWord'].'%22%2C%22show_ranked%22%3Afalse%2C%22first%22%3A30%2C%22after%22%3A%22QVFDeVM1VzVJQzJoQzlXWEhDdy1OUTNjUm54SzhfdUgxVnAwbWx2YXluSjZNaHl4OUh5VVdQUU4ycUhSTU5sNUJIVlptVG1JSUdCeTU0SE5vZGlfZlpLTA%3D%3D%22%7D');
        $tag = json_decode($page, true)['data']['hashtag'];
//        print_r( $tag['id']);
        $media = $tag['edge_hashtag_to_media'];
        $mediaItems =$tag['edge_hashtag_to_media']['edges'];

        echo '<br>';
        echo 'hashtag: ';
        print_r( $tag['name']);
        echo '<br>';
        echo 'id: ';
        print_r( $tag['id']);
        echo '<br>';
        echo 'кол-во: ';
//        print_r( $tag['taken_at_timestamp']);
        print_r( $tag['edge_hashtag_to_media']['count']);
        echo '<br>';
        echo 'время: ';
//        var_dump(date('Y-m-d H:i:s',(int)$tag['edge_hashtag_to_media']['edges'][0]['node']['taken_at_timestamp']));exit;
        print_r( date('Y-m-d H:i:s',(int)$tag['edge_hashtag_to_media']['edges'][0]['node']['taken_at_timestamp']));
        echo '<br>';
        $timeStamp = date('Y-m-d H:i:s',(int)$mediaItems[0]['node']['taken_at_timestamp']);
//        print_r( $tag['profile_pic_url']);echo '<br>';
//        $type = 'image/jpeg';
//        header('Content-Type:'.$type);
//        header('Content-Length: ' . filesize($tag['profile_pic_url']));
        echo '<img src="'.$tag['profile_pic_url'].'">';

        return [
            'id'=>$tag['id'],
            'name'=>$tag['name'],
            'profilePic'=>$tag['profile_pic_url'],
            'count'=>$media['count'],
            'date'=>$timeStamp,
        ];
//        if (preg_match('#window._sharedData[=\s]+(?P<json>\{.*});<\/script>#isu', $page, $match)) {
//            if ($json = json_decode($match['json'], true)) {
//                // в вашем случае такой "длинный" путь
//                var_dump($json);
//            } else {
//                echo 'не удалось распарсить JSON';
//            }
//        } else {
//            echo 'не удалось вытащить JSON';
//        }
//        var_dump(json_encode($this->html_to_obj($page), JSON_PRETTY_PRINT));
//        header("Content-Type: text/plain");
//        echo json_encode($this->html_to_obj($page), JSON_PRETTY_PRINT);
    }
}
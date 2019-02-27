<?php


namespace app\models;

use yii\base\Model;

class Instagram extends Model
{
    public static function getInfo($keyword)
    {
//        $keyword = '';
        return self::getItem(self::getInfoByTag($keyword));
    }
    public static function getItem($tagInfo, $num = 0)
    {
        $items = $tagInfo['edge_hashtag_to_media'];
        $item =$items['edges'][$num]['node'];
        $timeStamp = date('Y-m-d H:i:s',(int)$item[$num]['node']['taken_at_timestamp']);
//        $timeStamp = date('Y-m-d H:i:s',(int)$item[$num]['node']['taken_at_timestamp']);
        return [
            'id'=>$tagInfo['id'],
            'name'=>$tagInfo['name'],
            'profilePic'=>$tagInfo['profile_pic_url'],
            'count'=>$items['count'],
            'date'=>$timeStamp,
            'item'=>$item,
            'img'=>$item['display_url'],
            'like'=>$item['edge_liked_by']['count'],
            'user'=>$item['owner']['id'],
//            'itemDate'=>$timeStamp,

        ];
    }

    public static function getInfoByTag($keyWord)
    {
//        $model = new AuthInst();
        AuthInst::request();
        sleep(1);
//        $page = AuthInst::action('https://www.instagram.com/graphql/query/?query_hash=f92f56d47dc7a55b606908374b43a314&variables=%7B%22tag_name%22%3A%22yandex%22%2C%22show_ranked%22%3Afalse%2C%22first%22%3A30%2C%22after%22%3A%22QVFDeVM1VzVJQzJoQzlXWEhDdy1OUTNjUm54SzhfdUgxVnAwbWx2YXluSjZNaHl4OUh5VVdQUU4ycUhSTU5sNUJIVlptVG1JSUdCeTU0SE5vZGlfZlpLTA%3D%3D%22%7D');
        $page = AuthInst::action('https://www.instagram.com/graphql/query/?query_hash=f92f56d47dc7a55b606908374b43a314&variables=%7B%22tag_name%22%3A%22'.$keyWord.'%22%2C%22show_ranked%22%3Afalse%2C%22first%22%3A30%2C%22after%22%3A%22QVFDeVM1VzVJQzJoQzlXWEhDdy1OUTNjUm54SzhfdUgxVnAwbWx2YXluSjZNaHl4OUh5VVdQUU4ycUhSTU5sNUJIVlptVG1JSUdCeTU0SE5vZGlfZlpLTA%3D%3D%22%7D');

        return json_decode($page, true)['data']['hashtag'];
    }

    public function getJson($html)
    {
        if (preg_match('#window._sharedData[=\s]+(?P<json>\{.*});<\/script>#isu', $html, $match)) {
            if ($json = json_decode($match['json'], true)) {
                // в вашем случае такой "длинный" путь
                return $json;
            } else {
//                return 'не удалось распарсить JSON';
                return false;
            }
        } else {
//            return 'не удалось вытащить JSON';
            return false;
        }

    }

    public static function getItems($tag)
    {

        return $tag['edge_hashtag_to_media']['edges'];

    }

    public static function getTagInfo($keyword)
    {
//        $keyword = 'yandex';
        $items = self::getItems(self::getInfoByTag($keyword));

    }
}
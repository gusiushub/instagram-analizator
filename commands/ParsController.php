<?php
namespace app\commands;

use app\models\AuthInst;
use DOMDocument;
use GuzzleHttp\Client;
use yii\console\Controller;
use yii\console\ExitCode;

class ParsController extends Controller
{
    public function html_to_obj($html) {
//        $dom = new DOMDocument();
        $document = \phpQuery::newDocumentHTML($html);
//        $document->elements;
//        $dom->loadHTML($html);
//        return $this->element_to_obj($document->elements);
        var_dump($document->elements);
//        return $this->element_to_obj($dom->documentElement);
    }
    public function element_to_obj($element) {
        $obj = array( "tag" => $element->tagName );
        foreach ($element->attributes as $attribute) {
            $obj[$attribute->name] = $attribute->value;
        }
        foreach ($element->childNodes as $subElement) {
            if ($subElement->nodeType == XML_TEXT_NODE) {
                $obj["html"] = $subElement->wholeText;
            }
            else {
                $obj["children"][] = $this->element_to_obj($subElement);
            }
        }
        return $obj;
    }
    public function actionIndex()
    {
//        echo $_POST['KeywordInput']['keyWord'];
//        return $_GET['r'].'sdfsdf';

        $model = new AuthInst();
        $model->request();
        sleep(1);
        $page = $model->action('https://www.instagram.com/graphql/query/?query_hash=f92f56d47dc7a55b606908374b43a314&variables=%7B%22tag_name%22%3A%22'.$_POST['KeywordInput']['keyWord'].'%22%2C%22show_ranked%22%3Afalse%2C%22first%22%3A10%2C%22after%22%3A%22QVFDeVM1VzVJQzJoQzlXWEhDdy1OUTNjUm54SzhfdUgxVnAwbWx2YXluSjZNaHl4OUh5VVdQUU4ycUhSTU5sNUJIVlptVG1JSUdCeTU0SE5vZGlfZlpLTA%3D%3D%22%7D');
        $tag = json_decode($page, true)['data']['hashtag'];
        print_r( $tag['id']);
        echo '<br>';
        echo 'hashtag: ';
        print_r( $tag['name']);
        echo '<br>';
        echo 'id: ';
        print_r( $tag['id']);
//        print_r( $tag['profile_pic_url']);echo '<br>';
//        $type = 'image/jpeg';
//        header('Content-Type:'.$type);
//        header('Content-Length: ' . filesize($tag['profile_pic_url']));
        echo '<img src="'.$tag['profile_pic_url'].'">';
//         readfile($tag['profile_pic_url']);
         return ExitCode::OK;
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
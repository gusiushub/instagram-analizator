<?php

namespace app\controllers;

use app\models\AuthInst;
use app\models\KeywordInput;
use toriphes\console\Runner;
use vova07\console\ConsoleRunner;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new KeywordInput();
        if ($model->load(Yii::$app->request->post())) {

            return $this->refresh();
        }
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionT()
    {
        ini_set('max_execution_time', '600');
//        echo 1;exit;
        $model = new AuthInst();
//        $model->auth();
        $model->request();
        sleep(5);
        $page = $model->action('https://www.instagram.com/graphql/query/?query_hash=f92f56d47dc7a55b606908374b43a314&variables=%7B%22tag_name%22%3A%22yandex%22%2C%22show_ranked%22%3Afalse%2C%22first%22%3A10%2C%22after%22%3A%22QVFDeVM1VzVJQzJoQzlXWEhDdy1OUTNjUm54SzhfdUgxVnAwbWx2YXluSjZNaHl4OUh5VVdQUU4ycUhSTU5sNUJIVlptVG1JSUdCeTU0SE5vZGlfZlpLTA%3D%3D%22%7D');

//        $page = $model->action('https://www.instagram.com/explore/tags/stackoverflow/');
        $json = json_decode($page,true);
//        var_dump($page);

    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}

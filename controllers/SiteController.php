<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Clients;
use app\models\LoginForm;
use app\models\ContactForm;
use app\components\Debug;


class SiteController extends Controller
{
    public function init()
    {
        if(!isset($_SESSION)) { $_SESSION=array(); }
        $this->layout="/main.php";
        if(array_key_exists('isUser',$_SESSION)) { $this->layout="/main2.php"; }
    }

    /**
     * @inheritdoc
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
     * @inheritdoc
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
        if(array_key_exists('isAdmin',$_SESSION)) { unset($_SESSION['isAdmin']); Yii::$app->user->logout(); }
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if(!isset($_SESSION['isUser']))
        {
            $model = new LoginForm();
            if ($model->load(Yii::$app->request->post()) && $model->login()) {
                Clients::cacheClients($_SESSION['usuari']['id']);
//                Debug::s(Yii::$app->cache['client'.$_SESSION['usuari']['id']],1);
                $this->layout="/main2.php";
                $this->redirect(Yii::getalias('@web')."/site");
            }
            return $this->render('login', [
                'model' => $model,
            ]);
        }
        $this->redirect(Yii::getalias('@web')."/site");
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

    public function actionDesconectar()
    {
        Yii::$app->cache['client'.$_SESSION['usuari']['id']]=FALSE;
        unset($_SESSION['isAdmin']);
        unset($_SESSION['isUser']);
        unset($_SESSION['usuari']);
        $this->redirect(Yii::getalias('@web')."/site");
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

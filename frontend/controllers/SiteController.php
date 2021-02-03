<?php
namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;




use app\models\data;
use common\models\User;
use common\models\ToDoList;








/**
 * Site controller
 */
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
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
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
     * @return mixed
     */
    public function actionIndex()
    {
        $model = User::find()->all();
        $list = ToDoList::find()->all();
        $not_equal = Yii::$app->user->identity->id ;
        $user_list = ToDoList::find()->where(['=', 'completed_by',  $not_equal ])->all();
        $user_list_created = ToDoList::find()->where(['=', 'created_by',  $not_equal ])->all();
        return $this->render('index',[
            'model'=>$model,
            'list'=>$list,
            'user_list'=>$user_list,
            'user_list_created'=>$user_list_created,
        ]);
    }


    public function actionUser($id)
    {

        $model = User::findOne($id);
        return $this->render('user', [
            'model' => $model,
        ]);
    }



    public function actionList($id)
    {

       

        $model = ToDoList::findOne($id);
        $user_gave = User::findOne($model->created_by);
        $user_get = User::findOne($model->completed_by);
        
        
        $model->created_by = $user_gave->username;
        $model->completed_by = $user_get->username;
        

        return $this->render('list', [
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
        $model = new ToDoList();

        $list = ToDoList::find()->all();
        $not_equal = Yii::$app->user->identity->id ;

        $users = User::find()->where(['!=', 'id', $not_equal])->all();

        
        if(Yii::$app->request->isAjax){
            
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                
                return $this->redirect(['list', 'id' => $model->id]);
            }
        }


        return $this->render('create', [
            'model' => $model,
            'list'=>$list,
            'not_equal' => $not_equal,
            'users' => $users
        ]);



    }





    public function actionUpdate($id)
    {

        
        $model = ToDoList::findOne($id);
        $list = ToDoList::find()->all();
        $not_equal = Yii::$app->user->identity->id ;


        $user_gave = User::findOne($model->created_by);
        $user_get = User::findOne($model->completed_by);
        
      

        $users = User::find()->where(['!=', 'id', $not_equal])->all();


        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
                
            return $this->redirect(['update', 'id' => $model->id]);
        }


        return $this->render('update', [
            'model' => $model,
            'users' => $users,
            'user_gave' => $user_gave,
            'user_get' => $user_get,

        ]);
    }







































































    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            Yii::$app->session->setFlash('success', 'You have been successfully logged in!');
            return $this->goHome();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        Yii::$app->session->setFlash('success', 'You have been successfully logged out!');
        return $this->redirect(['site/login']);
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
    
}

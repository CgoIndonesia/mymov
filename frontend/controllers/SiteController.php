<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use frontend\models\ContactForm;
use frontend\models\VerifyEmailForm;
use common\models\Guides;
use common\models\Team;
use common\models\Feedbacks;
use common\models\Blocks;
use common\models\Order;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\SignupForm;
use yii\base\InvalidArgumentException;

use PDO;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */


    /**
     * @inheritdoc
     */

    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            // change layout for error action
            if ($action->id=='error')
                $this->layout ='error';
            return true;
        } else {
            return false;
        }
    }

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

    
    public function actionIndex()
    {
      
        
        return $this->render('index');

    }

    public function actionMedia()
    {


        return $this->render('media');

    }

    public function actionGuides()
    {
         $order = Order::find()->where(['source_type'=>3])->one();
        $ids = $order->order;
        $dataProvider = new ActiveDataProvider([
            'query' => Guides::find()->orderBy([new \yii\db\Expression(sprintf("FIELD(id, %s)", implode(",", [$ids])))]),
            'pagination' => [
            'pageSize' => 10,
            ],
            ]);

        return $this->render('guides', [
            'dataProvider' => $dataProvider,
            ]);
    }
    public function actionTeam()
    {
         $order = Order::find()->where(['source_type'=>4])->one();
        $ids = $order->order;
        $dataProvider = new ActiveDataProvider([
            'query' => Team::find()->orderBy([new \yii\db\Expression(sprintf("FIELD(id, %s)", implode(",", [$ids])))]),

            ]);

        return $this->render('team', [
            'dataProvider' => $dataProvider,
            ]);
    }
    public function actionFeedbacks()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Feedbacks::find(),
            'pagination' => [
            'pageSize' => 10,
            ],
            ]);
        $feedbacks = $dataProvider->getModels();
        return $this->render('feedbacks', [
            'dataProvider' => $feedbacks,
            ]);
    }


    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->body = '<p><b>Subject:</b>'.$model->subject.'</p>
                            <p><b>Customer Email:</b> '.$model->email.'</p>
                            <p><b>Customer Phone:</b> '.$model->phone.'</p>
                            <p><b>Message:</b> '.$model->body.'</p>';

            if ($model->sendEmail(Yii::$app->params['adminEmail'], Yii::$app->params['cc_email'])) {
                Yii::$app->session->setFlash('success', 'Thankkk you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
                ]);
        }
    }


    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionMyMovie()
    {

        $model = Blocks::find()->where(['name'=>'pricelist'])->one();
        return $this->render('mymovie', [
            'model' => $model,
            ]);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

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

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

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
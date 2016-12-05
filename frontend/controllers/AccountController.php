<?php
namespace frontend\controllers;

use common\models\Account;
use common\models\Activation;
use common\models\ActivityLog;
use common\models\ConnectOldAccount;
use common\models\ConnectOldAccountRequest;
use common\models\NotificationLog;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use common\models\virtual\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;

/**
 * Account controller
 */
class AccountController extends Controller
{
    public $layout = '@app/views/layouts/login';

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
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['login']);
        }
        return $this->redirect(['/dashboard']);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['/dashboard']);
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['/dashboard']);
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        ActivityLog::addEntry(
            ActivityLog::EVENT_ACP_LOGOUT,
            Yii::$app->user->id
        );
        Yii::$app->user->logout();
        return $this->redirect(['index']);
    }

    /**
     * Activates account
     *
     * @return mixed
     */
    public function actionActivate($id)
    {
        $model = Activation::find()
            ->where([
                'act_id' => $id
            ])
            ->one();
        if ($model == null) {
            Yii::$app->session->setFlash('danger', 'Invalid activation link. Please use correct URL and try again.');
        } else {
            $account = Account::find()
                ->where([
                    'c_id' => $model->account,
                    'c_status' => Account::STATUS_NEW
                ])
                ->one();
            if ($account == null) {
                Yii::$app->session->setFlash('danger', 'Account has already been activated.');
            } else {
                $account->c_status = Account::STATUS_ACTIVE;
                if ($account->save()) {
                    ActivityLog::addEntry(
                        ActivityLog::EVENT_ACCOUNT_ACTIVATED,
                        $account->c_id
                    );
                    Yii::$app->session->setFlash('success', 'Account has been activated. See you in game!');
                } else {
                    Yii::$app->session->setFlash('danger', 'There was some error activating you account. Please try again later.');
                }
            }
        }
        return $this->redirect(['login']);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Thank you for signing up. Please check your email and activate your account.');
            return $this->redirect(['login']);
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
    public function actionForgotPassword()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->redirect(['login']);
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for username provided. Please contact GM!');
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
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');
            return $this->redirect(['login']);
        }
        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionConfirmTransfer($token)
    {
        $model = ConnectOldAccountRequest::find()
            ->where(['token' => $token])
            ->one();
        if ($model == null) {
            Yii::$app->session->setFlash('danger', 'Please check the confirmation link and try again.');
        } else {
            if ($model->connectOldAccount->status != ConnectOldAccount::STATUS_PENDING) {
                Yii::$app->session->setFlash('danger', 'Account transfer request has already been verified.');
            } else {
                $model->connectOldAccount->status = ConnectOldAccount::STATUS_VERIFIED;
                if (!$model->connectOldAccount->save()) {
                    Yii::$app->session->setFlash('danger', 'Could not complete your verification process. Please try again later.');
                } else {
                    ActivityLog::addEntry(
                        ActivityLog::EVENT_OLD_ACCOUNT_TRANSFER_REQUEST_VERIFIED,
                        $model->connectOldAccount->current_account,
                        [
                            'old_account' => $model->connectOldAccount->old_account,
                            'request_id' => $model->id
                        ]
                    );
                    NotificationLog::sendMail(
                        NotificationLog::TYPE_TRANSFER_OLD_ACCOUNT_CONFIRM,
                        'support@a3-flamez.com',
                        [
                            'old_account' => $model->connectOldAccount->old_account,
                            'current_account' => $model->connectOldAccount->current_account
                        ]
                    );
                    Yii::$app->session->setFlash('success', 'Your request was confirmed successfully. It will shortly be processed.');
                }
            }
        }
        return $this->redirect(['login']);
    }
}

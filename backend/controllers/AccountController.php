<?php
namespace backend\controllers;

use common\models\ActivityLog;
use Yii;
use yii\web\Controller;
use backend\models\LoginForm;

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
            ActivityLog::EVENT_ADMIN_PANEL_LOGOUT,
            Yii::$app->user->id
        );
        Yii::$app->user->logout();
        return $this->redirect(['index']);
    }
}

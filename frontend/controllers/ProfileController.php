<?php

namespace frontend\controllers;

use common\models\User;
use frontend\models\ProfileChangePasswordForm;
use frontend\models\ProfileUpdateForm;
use frontend\models\SignupForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class ProfileController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     *
     *
     *
     */
    public function actionIndex() {
        return $this->render('index', [
            'model' => $this->findModel(),
        ]);
    }

    /**
     * @return User the loaded model
     */
    private function findModel()
    {
        return User::findOne(Yii::$app->user->identity->getId());
    }

    /**
     * Update user info.
     *
     * @return mixed
     */
    public function actionUpdate()
    {
        $user = $this->findModel();
        $model = new ProfileUpdateForm($user);

        if ($model->load(Yii::$app->request->post()) && $model->update()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionChangePassword() {
        $user = $this->findModel();
        $model = new ProfileChangePasswordForm($user);

        if ($model->load(Yii::$app->request->post()) && $model->changePassword()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('changepassword', [
                'model' => $model,
            ]);
        }
    }
}
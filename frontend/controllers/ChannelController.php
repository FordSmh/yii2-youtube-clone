<?php

namespace frontend\controllers;

use common\models\query\Subscriber;
use common\models\query\Videos;
use common\models\User;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ChannelController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['subscribe', 'my'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ]
        ];
    }

    public function actionView($username) {
        $channel = $this->findChannel($username);

        $dataProvider = new ActiveDataProvider([
            'query' => Videos::find()->creator($channel->id)->published()
        ]);

        return $this->render('view' , [
            'channel' => $channel,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionSubscribe($username) {
        $channel = $this->findChannel($username);
        $userId = \Yii::$app->user->id;

        $subscriber = $channel->isSubscribed($userId);
        if (!$subscriber) {
            $subscriber = new Subscriber();
            $subscriber->channel_id = $channel->id;
            $subscriber->user_id = $userId;
            $subscriber->created_at = time();
            $subscriber->save();

            \Yii::$app->mailer->compose([
                'html' => 'subscriber-html', 'text' => 'subscriber-text'
            ], [
                'channel' => $channel,
                'user' => \Yii::$app->user->identity
            ])
                ->setFrom(\Yii::$app->params['senderEmail'])
                ->setTo($channel->email)
                ->setSubject('You have new subscriber')
                ->send();
        } else {
            $subscriber->delete();
        }

        return $this->renderAjax('_subscribe', [
            'channel' => $channel
        ]);


    }

    protected function findChannel($username)
    {
        $channel = User::findByUsername($username);
        if (!$channel) {
            throw new NotFoundHttpException();
        }
        return $channel;
    }

    public function actionMy() {
        $user = User::findOne(\Yii::$app->user->id);
        $this->redirect(['/channel/view', 'username' => $user->username]);
    }

}
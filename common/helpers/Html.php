<?php

namespace common\helpers;

use common\models\User;
use yii\helpers\Url;

class Html
{
    public static function channelLink($user, $schema = false) {
        return \yii\helpers\Html::a($user->username, Url::to([
            'channel/view', 'username' => $user->username
        ], $schema),
        ['class' => 'text-muted']);
    }

    public static function channelUrl($userId){
        if (\Yii::$app->user->isGuest) {
            return Url::to('/site/login');
        }
        $user = User::findOne($userId);
        return Url::to(['channel/view', 'username' => $user->username]);
    }
}
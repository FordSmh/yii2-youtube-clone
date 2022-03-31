<?php

use common\models\User;
use yii\helpers\Url;

/** @var $channel User */
?>
<div class="input-group">
    <a class="btn
        <?php echo $channel->isSubscribed(\Yii::$app->user->id) ? 'btn-outline-danger' : 'btn-danger'?>"
       href="<?php echo Url::to(['channel/subscribe', 'username' => $channel->username])?>"
       data-method="post"
       data-pjax="1">
        <i class="far fa-bell"></i>
        Subscribe
    </a>
    <span class="bg-danger border-danger input-group-text text-white" id="basic-addon1"><?php echo $channel->getSubscribers()->count()?></span>
</div>
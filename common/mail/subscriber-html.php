<?php
/** @var $channel \common\models\User */
/** @var $user \common\models\User */
?>

<p>Hello <?php echo $channel->username?></p>
<p>User <?= \common\helpers\Html::channelLink($user, true)?> has just subscribed to your channel</p>

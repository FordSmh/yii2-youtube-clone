<?php
/** @var $channel User */
/** @var $this View */

use common\models\User;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Pjax; ?>

<div class="h-100 p-5 bg-light border rounded-3">
    <h2><?=$channel->username?></h2>
    <?php Pjax::begin()?>
    <?php echo $this->render('_subscribe', [
            'channel' => $channel
            ])?>
    <?php Pjax::end()?>
</div>
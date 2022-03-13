<?php
/** @var $channel User */
/** @var $this View */
/** @var $dataProvider \yii\data\ActiveDataProvider */

use common\models\User;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Pjax; ?>

<div class="h-100 p-5 bg-light border rounded-3 mb-3">
    <h2><?=$channel->username?></h2>
    <?php Pjax::begin()?>
    <?php echo $this->render('_subscribe', [
            'channel' => $channel
            ])?>
    <?php Pjax::end()?>
</div>

<?php echo \yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '@frontend/views/videos/_video_item',
    'layout' => '<div class="row row-cols-1 row-cols-md-4 g-4">{items}</div>{pager}',
    'itemOptions' => [
        'tag' => false
    ]
]);?>
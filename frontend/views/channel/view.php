<?php
/** @var $channel User */
/** @var $this View */
/** @var $dataProvider \yii\data\ActiveDataProvider */

use common\models\User;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Pjax;

$this->title = $channel->username . ' - ' . Yii::$app->name;
?>

<div class="p-5 bg-light border rounded-3 mb-3">
    <div class="d-flex align-items-center">
        <div class="flex-shrink-0">
            <img class="ratio rounded-circle" style="max-width: 100px" src="<?=$channel->getFullPicturePath($channel->profile_picture)?>">
        </div>
        <div class="flex-grow-1 ms-3">
            <h2><?=$channel->username?></h2>
            <?php Pjax::begin()?>
            <?php echo $this->render('_subscribe', [
                'channel' => $channel
            ])?>
            <?php Pjax::end()?>
        </div>
    </div>

</div>

<?php echo \yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '@frontend/views/videos/_video_item',
    'layout' => '<div class="row row-cols-1 row-cols-md-4 g-4">{items}</div>{pager}',
    'itemOptions' => [
        'tag' => false
    ]
]);?>
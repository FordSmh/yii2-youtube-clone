<?php
/** @var $model \common\models\query\Videos */

use yii\helpers\Url;

?>
<a href="<?php echo Url::to(['/videos/like', 'id' => $model->video_id])?>"
   class="btn btn-sm
   <?= $model->isLikedBy(Yii::$app->user->id) ? 'btn-outline-primary' : 'btn-outline-secondary'?>"
   data-method="post"
   data-pjax="1">
    <i class="fas fa-thumbs-up"></i>
    <?php $likes = $model->getLikes()->count();
    echo $likes ? $likes : '';?>
</a>
<a href="<?php echo Url::to(['/videos/dislike', 'id' => $model->video_id])?>"
   class="btn btn-sm
   <?= $model->isDislikedBy(Yii::$app->user->id) ? 'btn-outline-primary' : 'btn-outline-secondary'?>"
   data-method="post"
   data-pjax="1">
    <i class="fas fa-thumbs-down"></i>
    <?php $likes = $model->getDislikes()->count();
    echo $likes ? $likes : '';?>
</a>
<?php
/** @var $model \common\models\query\Videos */

use yii\helpers\Url;


$profilePicture = $model->createdBy->getFullPicturePath($model->createdBy->profile_picture);
?>
<div class="col">
    <div class="card border-0">
        <a href="<?php echo Url::to(['/videos/watch', 'id' => $model->video_id]) ?>">
            <video poster="<?=$model->getThumbnailLink()?>" class="ratio ratio-16x9" src="<?=$model->getVideoLink()?>"></video>
        </a>
        <div class="card-body px-0">

            <div class="d-flex">
                <div class="flex-shrink-0">
                    <a class="text-decoration-none text-dark" href="<?=Url::to(['channel/view', 'username' => $model->createdBy->username])?>">
                        <img style="max-width: 50px" class="rounded-circle ratio" src="<?=$profilePicture ? $profilePicture : Yii::$app->params['defaultProfilePicture']?>" alt="...">
                    </a>
                </div>
                <div class="flex-grow-1 ms-3">
                    <a class="text-decoration-none text-dark" href="<?php echo Url::to(['/videos/watch', 'id' => $model->video_id]) ?>">
                        <h3 class="h6 card-title main-video-title mb-1"><?=$model->title?></h3>
                    </a>
                    <p class="text-muted card-text m-0"><?php echo \common\helpers\Html::channelLink($model->createdBy)?></p>
                    <p class="text-muted card-text m-0"><?=$model->getViews()->count()?> views • <?=Yii::$app->formatter->asRelativeTime($model->created_at)?></p>
                </div>
            </div>

        </div>
    </div>
</div>

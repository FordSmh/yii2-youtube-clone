<?php
/** @var $model \common\models\query\Videos */

use yii\helpers\Url;

?>
<div class="col">
    <div class="card">
        <a href="<?php echo Url::to(['/videos/view', 'id' => $model->video_id]) ?>">
            <video poster="<?=$model->getThumbnailLink()?>" class="ratio ratio-16x9 mb-2" src="<?=$model->getVideoLink()?>"></video>
        </a>
        <div class="card-body">
            <h5 class="card-title"><?=$model->title?></h5>
            <p class="text-muted card-text m-0"><?=$model->createdBy->username?></p>
            <p class="text-muted card-text m-0"><?=$model->getViews()->count()?> views. <?=Yii::$app->formatter->asRelativeTime($model->created_at)?></p>
        </div>
    </div>
</div>

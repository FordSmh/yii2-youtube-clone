<?php
/** @var $model \common\models\query\Videos */

use yii\helpers\Url;
?>
<div class="col-12 col-md-8">
    <div class="card mb-3 border-0">
        <div class="row g-0">
            <div class="col-md-4">
                <a href="<?php echo Url::to(['/videos/watch', 'id' => $model->video_id]) ?>">
                    <video poster="<?=$model->getThumbnailLink()?>" class="ratio ratio-16x9" src="<?=$model->getVideoLink()?>"></video>
                </a>
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?=$model->title?></h5>
                    <p class="card-text"><?=\yii\helpers\StringHelper::truncate($model->description, 140)?></p>
                    <p class="text-muted card-text m-0"><?php echo \common\helpers\Html::channelLink($model->createdBy)?></p>
                    <p class="text-muted card-text m-0"><?=$model->getViews()->count()?> views. <?=Yii::$app->formatter->asRelativeTime($model->created_at)?></p>
                </div>
            </div>
        </div>
    </div>
</div>
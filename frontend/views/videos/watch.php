<?php
/** @var $model \common\models\query\Videos */
/** @var $similarVideos \common\models\query\Videos[] */

use yii\helpers\Html;
use yii\helpers\Url;
$this->title = $model->title . ' - ' . Yii::$app->name;
?>
<div class="row">
    <div class="col-12 col-sm-8">
        <div class="mb-3 ">
            <video controls poster="<?=$model->getThumbnailLink()?>" class="ratio ratio-16x9" src="<?=$model->getVideoLink()?>">
            </video>
        </div>
        <div class="d-flex justify-content-between">
            <div>
                <h1 class="h5"><?=$model->title?></h1>
                <p><?=$model->getViews()->count()?> views . <?=Yii::$app->formatter->asDate($model->created_at)?></p>
            </div>
            <div style="min-width: 100px;" class="text-end">
                <?php \yii\widgets\Pjax::begin();?>
                <?= $this->render('_like_dislike_buttons', [
                    'model' => $model
                ]);?>
                <?php \yii\widgets\Pjax::end();?>
            </div>

        </div>

        <div>
            <p><?php echo \common\helpers\Html::channelLink($model->createdBy)?></p>
            <p><?=Html::encode($model->description)?></p>
        </div>

    </div>

    <div class="col-12 col-sm-4">
        <?php foreach ($similarVideos as $similarVideo): ?>
            <div class="row mb-2">
                <div class="col">
                    <div class="card border-0">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <a href="<?php echo Url::to(['/videos/watch', 'id' => $similarVideo->video_id]) ?>">
                                    <video poster="<?=$similarVideo->getThumbnailLink()?>" class="ratio ratio-16x9" src="<?=$similarVideo->getVideoLink()?>"></video>
                                </a>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body py-0">
                                    <a class="text-decoration-none text-dark" href="<?php echo Url::to(['/videos/watch', 'id' => $similarVideo->video_id]) ?>">
                                        <h5 class="h6 card-title mb-0 main-video-title"><?=$similarVideo->title?></h5>
                                    </a>
                                    <p class="text-muted card-text m-0"><?php echo \common\helpers\Html::channelLink($similarVideo->createdBy)?></p>
                                    <p class="text-muted card-text m-0"><?=$similarVideo->getViews()->count()?> views. <?=Yii::$app->formatter->asRelativeTime($similarVideo->created_at)?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php

use \yii\helpers\StringHelper;
use yii\helpers\Url;

/** @var $model \common\models\query\Videos */
?>
<div class="d-flex">
    <div class="flex-shrink-0">
        <a href="<?=Url::to(['videos/update', 'video_id' => $model->video_id])?>">
            <video poster="<?=$model->getThumbnailLink()?>" class="ratio ratio-16x9 mr-2" style="width:140px">
                <source src="<?=$model->getVideoLink()?>" type="video/mp4">
            </video>
        </a>
    </div>
    <div class="flex-grow-1 ms-3">
        <h6 class="mb-1"><?=$model->title?></h6>
        <p><?=StringHelper::truncateWords($model->description, 10)?></p>
    </div>
</div>
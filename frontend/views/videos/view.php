<?php
/** @var $model \common\models\query\Videos */
?>
<div class="row">
    <div class="col-12 col-sm-8">
        <video controls poster="<?=$model->getThumbnailLink()?>" class="ratio ratio-16x9 mb-2" src="<?=$model->getVideoLink()?>"></video>
        <h1 class="h5"><?=$model->title?></h1>
        <p>123 views . <?=Yii::$app->formatter->asDate($model->created_at)?></p>
    </div>
    <div class="col-12 col-sm-4">

    </div>
</div>

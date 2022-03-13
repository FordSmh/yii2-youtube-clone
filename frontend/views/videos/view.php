<?php
/** @var $model \common\models\query\Videos */

use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="row">
    <div class="col-12 col-sm-8">
        <video controls poster="<?=$model->getThumbnailLink()?>" class="ratio ratio-16x9 mb-2" src="<?=$model->getVideoLink()?>"></video>
        <h1 class="h5"><?=$model->title?></h1>
        <p><?=$model->getViews()->count()?> views . <?=Yii::$app->formatter->asDate($model->created_at)?></p>
        <?php \yii\widgets\Pjax::begin();?>
        <?= $this->render('_like_dislike_buttons', [
                'model' => $model
        ]);?>
        <?php \yii\widgets\Pjax::end();?>
        <div>
            <p><?php echo \common\helpers\Html::channelLink($model->createdBy)?></p>
            <p><?=Html::encode($model->description)?></p>
        </div>
    </div>
    <div class="col-12 col-sm-4">

    </div>
</div>

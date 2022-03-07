<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\query\Videos */
/* @var $form yii\bootstrap5\ActiveForm */
?>

<div class="videos-form">

    <?php $form = ActiveForm::begin(
            ['options' => ['enctype' => 'multipart/form-data']]
    );?>

    <div class="row">
        <?= $form->errorSummary($model)?>
        <div class="col-sm-8">

            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

            <div class="form-group">
                <div class="mb-3">
                    <label for="thumbnail" class="form-label"><?=$model->getAttributeLabel('thumbnail')?></label>
                    <input class="form-control" type="file" id="thumbnail" name="thumbnail">
                </div>
            </div>

            <?= $form->field($model, 'tags')->textInput(['maxlength' => true]) ?>

        </div>
        <div class="col-sm-4 bg-light py-2">
            <video poster="<?=$model->getThumbnailLink()?>" class="ratio ratio-16x9 mb-2" controls>
                <source src="<?=$model->getVideoLink()?>" type="video/mp4">
            </video>
            <div>
                <p class="text-muted m-0">Video link</p>
                <p><a href="<?=$model->getVideoLink()?>"><?=$model->getVideoLink()?></a></p>
            </div>
            <div>
                <p class="text-muted m-0">Filename</p>
                <p><?=$model->video_name?></p>
            </div>
            <?= $form->field($model, 'status')->dropDownList($model->getStatusLabels()) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

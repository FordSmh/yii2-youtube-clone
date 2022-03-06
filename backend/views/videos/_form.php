<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\query\Videos */
/* @var $form yii\bootstrap5\ActiveForm */
?>

<div class="videos-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-8">

            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
            <?= $form->field($model, 'tags')->textInput(['maxlength' => true]) ?>

        </div>
        <div class="col-sm-4 bg-light py-2">
            <video class="ratio ratio-16x9 mb-2" controls>
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

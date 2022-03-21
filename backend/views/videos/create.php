<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\query\Videos */

$this->title = 'Upload a video';

?>
<div class="videos-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <p class="text-muted">Your video will stay private until you make it public.</p>
    <?php $form = \yii\widgets\ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ])?>
    <?=$form->errorSummary($model);?>
    <div class="file-area border">
        <input type="file" id="videoFile" name="video"></input>
        <div class="file-dummy d-flex flex-column justify-content-center align-items-center">
            <p>Please drag and drop or select a file you want to upload</p>
            <div class="upload-icon text-center">
                <i class="fa-solid fa-upload"></i>
            </div>
        </div>
    </div>
    <?php \yii\widgets\ActiveForm::end()?>
</div>

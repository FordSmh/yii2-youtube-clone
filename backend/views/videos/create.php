<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\query\Videos */

$this->title = 'Create Videos';
$this->params['breadcrumbs'][] = ['label' => 'Videos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="videos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="d-flex flex-column justify-content-center align-items-center">
        <div class="upload-icon">
            <i class="fa-solid fa-upload"></i>
        </div>
        <br>
        <p class="m-0">Drag and drop a file you want to upload</p>
        <p class="text-muted">Your video will be private until you publish it</p>

        <?php \yii\widgets\ActiveForm::begin([
                'options' => ['enctype' => 'multipart/form-data']
        ])?>
        <button class="btn btn-secondary btn-file">
            Select file
            <input type="file" id="videoFile" name="video"></input>
        </button>
        <?php \yii\widgets\ActiveForm::end()?>
    </div>

</div>

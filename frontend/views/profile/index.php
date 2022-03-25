<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View
 * @var $model \common\models\User */

$this->title = Yii::t('app', 'User profile');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-profile">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="my-2">
        <?=Html::a('Change password', ['change-password'], ['class' => 'btn btn-secondary'])?>
        <?=Html::a('Update profile info', ['update'], ['class' => 'btn btn-secondary'])?>
    </div>
    <div class="d-flex mt-5 align-items-center">
        <div class="flex-shrink-0">
            <img class="ratio rounded-circle" style="max-width: 100px" src="<?=$model->getFullPicturePath($model->profile_picture)?>">
        </div>
        <div class="flex-grow-1 ms-3">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'username',
                    'email'
                ],
                'options' => ['class' => 'table table-hover table-border mb-0']
            ]) ?>
        </div>
    </div>


</div>
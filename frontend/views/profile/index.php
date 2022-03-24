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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'email',
        ],
    ]) ?>

</div>
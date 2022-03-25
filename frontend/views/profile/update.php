<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View
 * @var $model \common\models\User
 */

$this->title = 'Update user profile';
?>
<div class="user-profile-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="user-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'profilePicture')->fileInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
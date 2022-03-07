<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;

AppAsset::register($this);
$this->beginContent('@frontend/views/layouts/base.php')?>

    <div class="h-100">

        <main role="main" class="flex-shrink-0 p-2 p-md-5">
            <div class="container">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </main>
    </div>

<?php $this->endContent()?>
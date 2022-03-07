<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;

$this->beginContent('@frontend/views/layouts/base.php')?>
<div class="d-flex h-100">
    <aside><?php echo $this->render('_sidebar')?></aside>

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
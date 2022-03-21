<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;

$this->beginContent('@frontend/views/layouts/base.php')?>
<div class="row">

    <aside class="col-1 g-0">
        <?php echo $this->render('_sidebar')?>
    </aside>

    <div class="col-10 mt-5 px-5">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>

</div>
<?php $this->endContent()?>
<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;

$this->beginContent('@frontend/views/layouts/base.php')?>
<div class="row flex-grow-1">

    <aside id="aside" class="col-12 col-md-2 col-lg-1 g-0 collapse show collapse-horizontal">
        <?php echo $this->render('_sidebar')?>
    </aside>

    <div class="col my-5 px-3 px-md-5">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>

</div>
<?php $this->endContent()?>
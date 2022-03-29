<?php
use yii\bootstrap5\BootstrapPluginAsset;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;

BootstrapPluginAsset::register(Yii::$app->view);
?>
<nav id="w4" class="navbar navbar-expand-md navbar-dark bg-dark navbar">
    <div class="container-fluid ps-0">
        <button type="button" class="border-0 d-block me-3 navbar-toggler" data-bs-toggle="collapse" data-bs-target="#aside" aria-controls="aside" aria-expanded="true" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <a class="navbar-brand" href="/">CloneTube</a>
        <div class="d-flex flex-fill justify-content-between">

    <?php
    $menuItems = [];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Sign up', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    ?>
    <form action="<?=\yii\helpers\Url::to(['/videos/search'])?>" class="d-flex col-12 col-md-4 ">
        <input class="form-control mx-3 bg-dark border-secondary text-white" type="search" placeholder="Search videos" name="keyword">
        <button class="btn btn-outline-secondary text-white" type="submit">Search</button>
    </form>
    <?php
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => $menuItems,
    ]);
    ?>

        </div>
    </div>
</nav>

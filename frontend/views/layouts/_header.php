<?php
use yii\bootstrap5\BootstrapPluginAsset;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;

BootstrapPluginAsset::register(Yii::$app->view);
?>
<nav id="w4" class="navbar navbar-expand-md navbar-dark bg-dark navbar">
    <div class="container-fluid ps-0 justify-content-md-between justify-content-start">
        <div class="d-flex">
            <button type="button" class="border-0 d-block me-3 navbar-toggler" data-bs-toggle="collapse" data-bs-target="#aside" aria-controls="aside" aria-expanded="true" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <a class="navbar-brand" href="/">CloneTube</a>
        </div>
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

            <div class="input-group">
                <input class="form-control bg-black border-secondary text-white" type="search" placeholder="Search videos" name="keyword">
                <button class="btn btn-outline-secondary text-white px-4" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>

        </form>
        <?php
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav'],
            'items' => $menuItems,
        ]);
        ?>

    </div>
</nav>

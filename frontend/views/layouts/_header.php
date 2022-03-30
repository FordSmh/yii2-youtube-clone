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
        $menuItems[] = [
                'label' => 'Upload a video',
                'url' => Yii::$app->urlManagerBackend->createAbsoluteUrl(['/videos/create'])
        ];
        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'Sign up', 'url' => ['/site/signup']];
            $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
        } else {
            $menuItems[] = [
                    'encode' => false,
                'label' => '<img style="max-width: 50px" class="rounded-circle ratio" src="'. \common\models\User::getFullPicturePathByUserId(Yii::$app->user->id) .'" alt="Profile picture">',
                'items' => [
                    ['label' => 'Your videos', 'url' => '/channel/my'],
                    ['label' => 'Clonetube Studio', 'url' => Yii::$app->urlManagerBackend->createAbsoluteUrl(['site/index'])],
                    '<div class="dropdown-divider"></div>',
                    ['label' => 'Profile', 'url' => '/profile/index'],
                    '<div class="dropdown-item">'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                        'Sign out (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'btn p-0 text-decoration-none']
                    )
                    . Html::endForm()
                    . '</div>',
                ],
                'linkOptions' => ['class' => 'p-0 ms-md-4', 'style' => 'max-width: 40px'],
                'dropdownOptions' => ['class' => 'dropdown-menu-end']
            ];
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

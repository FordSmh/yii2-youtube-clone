<?php
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

NavBar::begin([
    'brandLabel' => Yii::$app->name,
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar navbar-expand-md navbar-dark bg-dark',
    ],
]);
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
<form action="<?=\yii\helpers\Url::to(['/videos/search'])?>" class="d-flex">
    <input class="form-control me-2" type="search" placeholder="Search videos" name="keyword">
    <button class="btn btn-outline-success" type="submit">Search</button>
</form>
<?php
echo Nav::widget([
    'options' => ['class' => 'navbar-nav'],
    'items' => $menuItems,
]);
NavBar::end();
?>
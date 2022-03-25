<?php
    /** @var $dataProvider \yii\data\ActiveDataProvider */
?>
<?php
$this->title = 'Subscriptions' . ' - ' . Yii::$app->name;?>
<h1 class="mb-3">Your subscriptions</h1>
<?php
$exploreUrl = \yii\helpers\Url::to('/videos/explore');
echo \yii\widgets\ListView::widget([
   'dataProvider' => $dataProvider,
    'itemView' => '_video_item',
    'layout' => '<div class="row row-cols-1 row-cols-md-4 g-4">{items}</div>{pager}',
    'emptyText' => '<p>Hey, no videos has been found for you. You might check what is <a href="'.$exploreUrl .'">trending</a> today for new content</p>',
    'itemOptions' => [
            'tag' => false
    ]
]);
?>
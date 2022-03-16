<?php
    /** @var $dataProvider \yii\data\ActiveDataProvider */
?>
<h1>Found videos</h1>
<?php echo \yii\widgets\ListView::widget([
   'dataProvider' => $dataProvider,
    'itemView' => '_video_item',
    'layout' => '<div class="row row-cols-1 row-cols-md-4 g-4">{items}</div>{pager}',
    'itemOptions' => [
            'tag' => false
    ]
]);?>
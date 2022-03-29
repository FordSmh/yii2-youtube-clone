<?php
    /** @var $dataProvider \yii\data\ActiveDataProvider */
?>
<?php
$this->title =  Yii::$app->name;
echo \frontend\resource\ShuffledListView::widget([
   'dataProvider' => $dataProvider,
    'itemView' => '_video_item',
    'layout' => '<div class="row row-cols-1 row-cols-md-4 g-4">{items}</div>{pager}',
    'itemOptions' => [
            'tag' => false
    ]
]);?>
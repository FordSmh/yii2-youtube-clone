<?php
    /** @var $dataProvider \yii\data\ActiveDataProvider */

$this->title = 'Most viewed videos for today'  . ' - ' . Yii::$app->name;
?>
<h1 class="h2 mb-5">Most viewed videos for today</h1>

<?php echo \yii\widgets\ListView::widget([
   'dataProvider' => $dataProvider,
    'itemView' => '_history_item',
    'layout' => '<div class="row">{items}</div>{pager}',
    'itemOptions' => [
            'tag' => false
    ]
]);?>
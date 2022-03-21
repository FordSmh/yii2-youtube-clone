<?php
    /** @var $dataProvider \yii\data\ActiveDataProvider */

$this->title = 'History view page'  . ' - ' . Yii::$app->name;
?>
<h1 class="h2 mb-5">History view page</h1>

<?php echo \yii\widgets\ListView::widget([
   'dataProvider' => $dataProvider,
    'itemView' => '_history_item',
    'layout' => '<div class="row">{items}</div>{pager}',
    'itemOptions' => [
            'tag' => false
    ]
]);?>
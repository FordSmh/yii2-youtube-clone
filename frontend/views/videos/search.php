<?php
    /** @var $dataProvider \yii\data\ActiveDataProvider */
?>
<h1 class="h2 mb-5">Found videos</h1>
<?php
$this->title = 'Search' . ' - ' . Yii::$app->name;
echo \yii\widgets\ListView::widget([
   'dataProvider' => $dataProvider,
    'itemView' => '_search_item',
    'layout' => '<div class="row">{items}</div>{pager}',
    'itemOptions' => [
            'tag' => false
    ]
]);?>
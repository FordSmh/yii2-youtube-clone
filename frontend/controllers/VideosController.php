<?php

namespace frontend\controllers;

use common\models\query\Videos;
use common\models\query\VideoView;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class VideosController extends Controller
{
 public function actionIndex() {
     $dataProvider = new ActiveDataProvider([
         'query' => Videos::find()->published()
     ]);
     return $this->render('index', [
         'dataProvider' => $dataProvider
     ]);
 }
 public function actionView($id) {
    $video = Videos::findOne($id);
    if(!$video) {
        throw new NotFoundHttpException('Video does not exist.');
    }

    $videoView = new VideoView();
    $videoView->video_id = $id;
    $videoView->user_id = \Yii::$app->user->id;
    $videoView->created_at = time();
    $videoView->save();

    return $this->render('view', [
        'model' => $video
        ]);
 }
}
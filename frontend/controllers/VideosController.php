<?php

namespace frontend\controllers;

use common\models\query\VideoLike;
use common\models\query\Videos;
use common\models\query\VideoView;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class VideosController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['like', 'dislike', 'history'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ],
            'verb' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'like' => ['post'],
                    'dislike' => ['post'],
                ]
            ]
        ];
    }

    public function actionIndex() {
     $dataProvider = new ActiveDataProvider([
         'query' => Videos::find()->published()
     ]);
     return $this->render('index', [
         'dataProvider' => $dataProvider
     ]);
 }
 public function actionView($id) {

     $video = $this->findVideo($id);

     $videoView = new VideoView();
     $videoView->video_id = $id;
     $videoView->user_id = \Yii::$app->user->id;
     $videoView->created_at = time();
     $videoView->save();

    return $this->render('view', [
        'model' => $video
        ]);
 }
 public function actionLike($id) {
     $video = $this->findVideo($id);
     $userId = \Yii::$app->user->id;

     $videoLikeDislike = VideoLike::find()
         ->userIdVideoId($userId, $id)
         ->one();
     if (!$videoLikeDislike) {
         $this->saveLikeDislike($id, $userId, VideoLike::TYPE_LIKE);
     } else if ($videoLikeDislike->type == VideoLike::TYPE_LIKE) {
         $videoLikeDislike->delete();
     } else {
         $videoLikeDislike->delete();
         $this->saveLikeDislike($id, $userId, VideoLike::TYPE_LIKE);
     }

     return $this->renderAjax('_like_dislike_buttons', [
         'model' => $video
     ]);
 }

public function actionDislike($id) {
    $video = $this->findVideo($id);
    $userId = \Yii::$app->user->id;

    $videoLikeDislike = VideoLike::find()
        ->userIdVideoId($userId, $id)
        ->one();
    if (!$videoLikeDislike) {
        $this->saveLikeDislike($id, $userId, VideoLike::TYPE_DISLIKE);
    } else if ($videoLikeDislike->type == VideoLike::TYPE_DISLIKE) {
        $videoLikeDislike->delete();
    } else {
        $videoLikeDislike->delete();
        $this->saveLikeDislike($id, $userId, VideoLike::TYPE_DISLIKE);
    }

    return $this->renderAjax('_like_dislike_buttons', [
        'model' => $video
    ]);
}

 /**
  * Finds video by id
  *
  * @return Videos
  */

 protected function findVideo($id) {
     $video = Videos::findOne($id);
     if(!$video) {
         throw new NotFoundHttpException('Video does not exist.');
     }
     return $video;
 }

 protected function saveLikeDislike($videoId, $userId, $type) {
     $videoLikeDislike = new VideoLike();
     $videoLikeDislike->video_id = $videoId;
     $videoLikeDislike->user_id = $userId;
     $videoLikeDislike->type = $type;
     $videoLikeDislike->created_at = time();
     $videoLikeDislike->save();
 }
}
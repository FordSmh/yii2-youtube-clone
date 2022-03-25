<?php

namespace frontend\controllers;

use common\models\query\VideoLike;
use common\models\query\Videos;
use common\models\query\VideoView;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Html;
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

    public function actionSubscriptions() {
        $query = Videos::find()
            ->alias('v')
            ->innerJoin('subscriber s',
                's.channel_id = v.created_by And s.user_id = :user', ['user' => \Yii::$app->user->id])
            ->orderBy('v.created_at desc')
            ->published();

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        return $this->render('subscriptions', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionExplore() {
        $query = Videos::find()
            ->alias('v')
            ->innerJoin('video_view vv',
                'v.video_id = vv.video_id')
            ->where('cast(to_timestamp(vv.created_at) as date) = CURRENT_DATE')
            ->groupBy('v.video_id')
            ->orderBy('count(v.video_id) DESC');

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        return $this->render('explore', [
            'dataProvider' => $dataProvider
        ]);
    }

     public function actionWatch($id) {

         $video = $this->findVideo($id);

         $videoView = new VideoView();
         $videoView->video_id = $id;
         $videoView->user_id = \Yii::$app->user->id;
         $videoView->created_at = time();
         $videoView->save();

         $similarVideos = Videos::find()
             ->fulltextSearch($this->prepareStrForFtSearch($video->title))
             ->published()
             ->andWhere(['NOT', ['video_id' => $id]])
             ->all();

        return $this->render('watch', [
            'model' => $video,
            'similarVideos' => $similarVideos
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

    public function actionSearch($keyword) {
        $query = Videos::find()->fulltextSearch($this->prepareStrForFtSearch($keyword));

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        return $this->render('search', [
           'dataProvider' => $dataProvider,
        ]);

    }

    public function actionHistory() {

        $query = Videos::find()
            ->alias('v')
            ->innerJoin('(SELECT video_id, MAX(created_at) as max_date FROM video_view WHERE user_id = :userId GROUP BY video_id) as vv',
                'vv.video_id = v.video_id',
                ['userId' => \Yii::$app->user->id])
            ->orderBy('vv.max_date DESC');
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        return $this->render('history', [
            'dataProvider' => $dataProvider
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

     protected function prepareStrForFtSearch($string) {
         $string = preg_replace('/[^A-Za-z0-9\s]/', '', $string);
         $string = preg_replace('/\s{2,}/', ' ', $string);
         return str_replace(' ', ' | ',$string);
     }
}
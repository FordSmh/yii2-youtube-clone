<?php

namespace frontend\resource;

use common\models\query\Videos;
use common\models\query\VideoLike;
use common\models\query\VideoView;

class VideosRest extends Videos
{
    public function fields() {
        return
            [
                'video_id',
                'title',
                'description',
                'tags',
                'created_at',
                'created_by' => 'createdBy',
                'views',
                'likes',
                'dislikes'
            ];
    }

    public function getCreatedBy()
    {
        return $this->hasOne(UserRest::classname(), ['id' => 'created_by']);
    }

    public function getViews() {
        return $this->hasMany(VideoView::class, ['video_id' => 'video_id'])->count();
    }

    public function getLikes() {
        return $this->hasMany(VideoLike::class, ['video_id' => 'video_id'])
            ->liked()->count();
    }

    public function getDislikes() {
        return $this->hasMany(VideoLike::class, ['video_id' => 'video_id'])
            ->disliked()->count();
    }
}
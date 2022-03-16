<?php

namespace common\models\query;

use yii\helpers\Html;
use yii\base\Security;

/**
 * This is the ActiveQuery class for [[Videos]].
 *
 * @see Videos
 */
class VideosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Videos[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Videos|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function creator($userId) {
        return $this->andWhere(['created_by' => $userId]);
    }

    public function published() {
        return $this->andWhere(['status' => Videos::STATUS_PUBLISHED]);
    }

    public function byKeyword($keyword) {
        return $this->andWhere(['ilike', 'title', $keyword])
            ->orWhere(['ilike', 'description', $keyword])
            ->orWhere(['ilike', 'tags' , $keyword]);
    }
}

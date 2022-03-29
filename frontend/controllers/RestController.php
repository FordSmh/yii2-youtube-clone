<?php

namespace frontend\controllers;

use common\models\query\Videos;
use frontend\resource\VideosRest;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

class RestController extends ActiveController
{
    public $modelClass = VideosRest::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['except'] = ['index', 'view'];
        $behaviors['authenticator']['authMethods'] = [
            HttpBearerAuth::class
        ];


        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']);
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

        $actions['view']['findModel'] = static function ($id) {
            $model = VideosRest::findOne(['status' => Videos::STATUS_PUBLISHED, 'video_id' => $id]);
            if ($model === null) {
                throw new NotFoundHttpException("Object not found: $id");
            }
            return $model;
        };

        return $actions;
    }

    public function prepareDataProvider() {
        return new ActiveDataProvider([
           'query' => VideosRest::find()->published()
        ]);
    }

    /**
     * @param string $action
     * @param Videos $model
     * @param array $params
     */
    public function checkAccess($action, $model = null, $params = [])
    {
        if (in_array($action, ['update', 'delete']) && $model->created_by !== \Yii::$app->user->id) {
            throw new ForbiddenHttpException('You do not have rights to update this video');
        }
    }
}
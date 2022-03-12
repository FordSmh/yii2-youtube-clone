<?php

namespace common\models\query;

use Imagine\Image\Box;
use Yii;
use yii\base\Security;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use yii\web\UploadedFile;
use common\models\User;

/**
 * This is the model class for table "{{%videos}}".
 *
 * @property string $video_id
 * @property string $title
 * @property string|null $description
 * @property string|null $tags
 * @property int|null $status
 * @property bool|null $has_thumbnail
 * @property string|null $video_name
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 *
 * @property User $createdBy
 */
class Videos extends \yii\db\ActiveRecord
{

    const STATUS_UNLISTED = 0;
    const STATUS_PUBLISHED = 1;

    /**
     * @var UploadedFile
     */
    public $video;

    /**
     * @var UploadedFile
     */
    public $thumbnail;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%videos}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            [
                'class' => BlameableBehavior::class,
                'updatedByAttribute' => false
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['video_id', 'title'], 'required'],
            [['description'], 'string'],
            [['status', 'created_at', 'updated_at', 'created_by'], 'default', 'value' => null],
            [['status', 'created_at', 'updated_at', 'created_by'], 'integer'],
            [['has_thumbnail'], 'boolean'],
            [['video_id'], 'string', 'max' => 16],
            [['title', 'tags', 'video_name'], 'string', 'max' => 512],
            [['video_id'], 'unique'],
            ['has_thumbnail', 'default', 'value' => 0],
            ['status', 'default', 'value' => self::STATUS_UNLISTED],
            ['thumbnail', 'image', 'minWidth' => 600],
            ['video', 'file', 'extensions' => ['mp4', 'webm']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(),'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    public function getStatusLabels() {
        return [
            self::STATUS_UNLISTED => 'Unlisted',
            self::STATUS_PUBLISHED => 'Published'
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'video_id' => 'Video ID',
            'title' => 'Title',
            'description' => 'Description',
            'tags' => 'Tags',
            'status' => 'Status',
            'has_thumbnail' => 'Has Thumbnail',
            'video_name' => 'Video Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'thumbnail' => 'Thumbnail'
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getViews() {
        return $this->hasMany(VideoView::class, ['video_id' => 'video_id']);
    }

    /**
     * {@inheritdoc}
     * @return VideosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VideosQuery(get_called_class());
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        $isInsert = $this->isNewRecord;
        if ($isInsert) {
            $this->video_id = Yii::$app->security->generateRandomString(8);
            $this->title = $this->video->name;
            $this->video_name = $this->video->name;
        }
        if ($this->thumbnail) {
            $this->has_thumbnail = 1;
        }
        $saved = parent::save($runValidation, $attributeNames);

        if (!$saved) {
            return false;
        }
        if ($isInsert) {
            $videoPath = Yii::getAlias('@frontend/web/storage/videos/' . $this->video_id . '.mp4');
            if (!is_dir(dirname($videoPath))) {
                FileHelper::createDirectory(dirname($videoPath));
            }
            $this->video->saveAs($videoPath);
        }
        if ($this->thumbnail) {
            $thumbnailPath = Yii::getAlias('@frontend/web/storage/thumbs/' . $this->video_id . '.jpg');
            if (!is_dir(dirname($thumbnailPath))) {
                FileHelper::createDirectory(dirname($thumbnailPath));
            }
            $this->thumbnail->saveAs($thumbnailPath);
            Image::getImagine()
                ->open($thumbnailPath)
                ->thumbnail(new Box(1280, 720))
                ->resize(new Box(1280, 720))
                ->save($thumbnailPath);
        }

        return true;
    }

    public function getVideoLink() {
        return yii::$app->params['frontendUrl'].'storage/videos/'.$this->video_id.'.mp4';
    }

    public function getThumbnailLink() {
        return $this->has_thumbnail ? yii::$app->params['frontendUrl'].'storage/thumbs/'.$this->video_id.'.jpg' : ' ';
    }

    public function afterDelete()
    {
        parent::afterDelete();
        $videoPath = Yii::getAlias('@frontend/web/storage/videos/'.$this->video_id.'.mp4');
        $thumbnailPath = Yii::getAlias('@frontend/web/storage/thumbs/'.$this->video_id.'.jpg');
        unlink($videoPath);
        if(file_exists($thumbnailPath)) {
            unlink($thumbnailPath);
        }
    }
}

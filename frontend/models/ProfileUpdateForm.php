<?php

namespace frontend\models;

use common\models\User;
use Imagine\Image\Box;
use Yii;
use yii\base\Model;
use yii\imagine\Image;
use yii\web\UploadedFile;

class ProfileUpdateForm extends Model
{
    public $email;

    /**
     * @var UploadedFile
     */
    public $profilePicture;

    /**
     * @var User
     */
    private $_user;

    public function __construct(User $user, $config = [])
    {
        $this->_user = $user;
        $this->email = $user->email;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            ['email', 'required'],
            ['email', 'email'],
            [
                'email',
                'unique',
                'targetClass' => User::classname(),
                'message' => Yii::t('app', 'Error. Email already taken'),
                'filter' => ['<>', 'id', $this->_user->id],
            ],
            ['email', 'string', 'max' => 255],
            [['profilePicture'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg']
        ];
    }

    public function update()
    {
        if ($this->validate()) {
            $user = $this->_user;
            $user->email = $this->email;



            $profilePictureName = Yii::$app->security->generateRandomString(8);
            $profilePicturePath = Yii::getAlias('@frontend/web/storage/profilepics/' . $profilePictureName. '.' . $this->profilePicture->extension);
            $this->profilePicture->saveAs($profilePicturePath);
            Image::getImagine()
                ->open($profilePicturePath)
                ->resize(new Box(500, 500))
                ->save($profilePicturePath);
            $user->profile_picture = $profilePictureName. '.' . $this->profilePicture->extension;
            return $user->save();

        } else {
            return false;
        }
    }
}
<?php

namespace frontend\models;

use common\models\User;
use Yii;
use yii\base\Model;

class ProfileChangePasswordForm extends Model
{
    public $currentPassword;
    public $newPassword;
    public $newPasswordRepeat;

    private $_user;

    public function __construct(User $user, $config = [])
    {
        $this->_user = $user;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['currentPassword', 'newPassword', 'newPasswordRepeat'], 'required'],
            ['currentPassword', 'checkCurrentPassword'],
            ['newPassword', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
            ['newPasswordRepeat', 'compare', 'compareAttribute' => 'newPassword'],
        ];
    }

    /**
     * @param string $attribute
     * @param array $params
     */
    public function checkCurrentPassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if (!$this->_user->validatePassword($this->$attribute)) {
                $this->addError($attribute, Yii::t('app', 'ERROR_WRONG_CURRENT_PASSWORD'));
            }
        }
    }

    /**
     * @return boolean
     */
    public function changePassword()
    {
        if ($this->validate()) {
            $user = $this->_user;
            $user->setPassword($this->newPassword);
            return $user->save();
        } else {
            return false;
        }
    }

}
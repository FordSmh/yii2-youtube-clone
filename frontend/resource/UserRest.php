<?php

namespace frontend\resource;

use common\models\User;

class UserRest extends User
{
    public function fields()
    {
        return ['username'];
    }
}
<?php


namespace app\api\controller;

use app\common\business\User as UserBis;

class User extends AuthBase
{
    public function index()
    {
        // return true;
        $user = (new UserBis())->getNormalUserById($this->userId);
        $retUser = array(
            'id' => $this->userId,
            'username' => $user['username'],
            'sex' => $user['sex'],
        )
        return show(config('status.success'), 'Ok', $user);
    }
}
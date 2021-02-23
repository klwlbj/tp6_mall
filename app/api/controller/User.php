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
        );
        return show(config('status.success'), 'Ok', $user);
    }

    public function update()
    {
        $username = input('param.username', '', 'trim');
        $sex = input('param.sex', 0, 'intval');

        $data = array(
            // 'id' => $this->userId,
            'username' => $username,
            'sex' => $sex,
        );
        $validate = (new \app\api\validate\User())->scene('update_user');
        if (!$validate->check($data)) {
            return show(config('status.error'), $validate->getError());
        }
        $userBisObj = new UserBis();
        $user = $userBisObj->update($this->userId, $data);
        if (!$user) {
            return show(config('status.error'), 'update fail');
        }
        //相应redis数据也要改


        return show(config('status.success'), 'Ok', $user);
    }
}
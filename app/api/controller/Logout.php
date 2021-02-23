<?php


namespace app\api\controller;


class Logout extends AuthBase
{
    public function index()
    {
        // del redis token
        $res = cache(config('redis.token_pre') . $this->accessToken, null, 0); // 第二个参数必须为null,才能删除
        if ($res) {
            return show(config('status.success'), 'logout ok');
        } else {
            return show(config('status.error'), 'logout fail');
        }

    }
}
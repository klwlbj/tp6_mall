<?php

// declare(strict_types=1);
namespace app\api\controller;


use app\api\validate\User;
use app\BaseController;

class Login extends BaseController
{
    public function index()
    {
        $phoneNumber = $this->request->param('phone_number', '', 'trim');
        $code = input('param.code', 0, "intval");
        $type = input('param.type', 0, "intval");

        $data = array('phone_number' => $phoneNumber, "code" => $code, "type" => $type);
        $validate = new User();
        if (!$validate->scene('login')->check($data)) {
            return show(config('status.error'), $validate->getError());
        } else {
            try {
                $res = (new \app\common\business\User())->login($data);
            } catch (\Exception $e) {
                return show($e->getCode() . $e->getMessage());
            }
            if ($res) {
                return show(config('status.success'), 'success login', $res);
            }
            return show(config('status.error'), 'fail login');
        }
    }
}
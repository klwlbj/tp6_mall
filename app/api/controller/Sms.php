<?php
declare(strict_types=1);

namespace app\api\controller;

use app\api\validate\User;
use app\BaseController;
use think\exception\ValidateException;

use app\common\business\Sms as BSms;

class Sms extends BaseController
{
    public function code(): string
    {
        $phoneNumber = input('param.phone_number', '', 'trim');
        try {
            validate(User::class)->scene('send_code')->check(array('phone_number' => $phoneNumber));
        } catch (ValidateException $e) {
            return show(config('status.error'), $e->getError());
        }
        // 验证后就去调用business层数据
        if (BSms::sendCode($phoneNumber, 6)) {
            return show(config('status.success'), "send captcha ok");
        } else {
            return show(config('status.error'), "send captcha fail");
        }
    }
}
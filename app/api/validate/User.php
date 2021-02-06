<?php


namespace app\api\validate;

use think\validate;

class User extends validate
{
    protected $rule = array(
        'phone_number' => 'require',
        // 'username' => 'require',
        'code' => 'require|number|min:4',
        'type' => ['require', 'in'=> "1,2"],
    );

    protected $message = array(
        'username' => 'username can not be null',
        'phone_number' => 'phone_number can not be null',
        'code.require' => 'code require',
        'code.number' => 'code is number',
        'code.min' => 'code < 4',
        'type.require' => 'type require',
        'type.in' => 'type error',
    );

    protected $scene = [
        'send_code ' => ['phone_number'],
        "login" => ['phone_number', "code", "type"],
    ];
}
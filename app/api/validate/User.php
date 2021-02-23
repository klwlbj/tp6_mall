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
        'sex' => ['require', 'in'=>'0,1,2']
    );

    protected $message = array(
        'username' => 'username can not be null',
        'phone_number' => 'phone_number can not be null',
        'code.require' => 'code require',
        'code.number' => 'code is number',
        'code.min' => 'code < 4',
        'type.require' => 'type require',
        'type.in' => 'type error',
        'sex.require' => 'sex require',
        'sex.in'=>'sex not in'
    );

    protected $scene = [
        'send_code ' => ['phone_number'],
        "login" => ['phone_number', "code", "type"],
        "update_user" => ['username', "sex"],
    ];
}
<?php


namespace app\api\validate;

use think\validate;

class User extends validate
{
    protected $rule = array(
        'phone_number' => 'require',
        // 'username' => 'require',
    );

    protected $message = array(
        'username' => 'username can not be null',
        'phone_number' => 'phone_number can not be null'
    );

    protected $scene = [
        'send_code ' => ['phone_number'],
    ];
}
<?php
/**
 * Created by PhpStorm.
 * User: sikwansing
 * Date: 2021/1/17
 * Time: 18:17
 */

namespace app\admin\validate;

use think\validate;
use app\admin\controller\Verify;

class AdminUser extends validate
{
    protected $rule = [
        'username' => 'require',
        'password' => 'require',
        'captcha' => 'require|checkCapcha',
    ];
    protected $message = array(
        'username' => 'username is required',
        'password' => 'password is required',
        'captcha' => 'captcha is required',
    );

    protected function checkCapcha($value, $rule, $data = [])
    {
        if (!Verify::captcha_check($value)) { // 验证码存于session中，需要开启session
            return 'capcha is error';
        }
        return true;
    }
}
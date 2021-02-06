<?php


namespace app\common\business;

use app\common\model\mysql\User as UserModel;
use think\Exception;

class User
{
    public $userObj = null;

    public function __construct()
    {
        $this->userObj = new UserModel();
    }

    public function login($data)
    {
        $redisCode = cache(config('redis.code_pre') . $data['phone_number']);
        if ($redisCode == '' || $redisCode != $data['code']) {
            throw new Exception('不存在验证码', '1011');
        }

        //判断表里是否有用户记录
        // 生成token 记录到redis里
        $user = $this->userObj->getUsernameByPhoneNumber($data['phone_number']);
        $username = 'sks'.$data['phone_number'];
        if(!$user){
            $userData = array(
                'username' => $username,
                'phone_number' => $data['phone_number'],
                'type' => $data['type'],
                'status' => config('status.mysql.table_normal')
            );
            try {
                $saveRes = $this->userObj->save($userData);
                $userId = $saveRes->id;
            }catch (\Exception $e){
                throw new \think\Exception('mysql is not normal');
            }
        }else{
            // update表
            $userData = array(

            );
        }
    }
}
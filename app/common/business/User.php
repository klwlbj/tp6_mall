<?php


namespace app\common\business;

use app\common\lib\Str;
use app\common\lib\Time;
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
            // throw new Exception('不存在验证码', '1011');
        }

        //判断表里是否有用户记录
        // 生成token 记录到redis里
        $user = $this->userObj->getUsernameByPhoneNumber($data['phone_number']);
        $username = 'sks' . $data['phone_number'];
        if (!$user) {
            $userData = array(
                'username' => $username,
                'phone_number' => $data['phone_number'],
                'type' => $data['type'],
                'status' => config('status.mysql.table_normal')
            );
            try {
                $this->userObj->save($userData);
                $userId = $this->userObj->id;
            } catch (\Exception $e) {
                throw new \think\Exception('mysql is not normal');
            }
        } else {
            $adminUserObj = $this->userObj;
            // update表
            $res = $adminUserObj->updateByPhoneNumber($data['phone_number'], array(
                'last_login_ip' => request()->ip(),
                'last_login_time' => time(),
                // 'update_time' => time(),
            ));
            /*if (!empty($res)) {
                return true;
            }*/
        }
        $username = $user->username;
        $token = Str::getLoginToken($data['phone_number']);
        $redisData = array(
            'id' => $user->id,
            'username' => $username,
        );
        $cacheRes = cache(config('redis.token_pre') . $token, $redisData, Time::userLoginExpiresTime($data['type']));
        return $cacheRes ? compact('token', 'username') : false;
    }

    /**
     * 返回正常用户数据
     * @param $id
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getNormalUserById($id)
    {
        $user = $this->userObj->getUserById($id);
        if (!$user || $user->status != config('status.mysql.table_normal')) {
            return [];
        }
        return $user->toArray();
    }

    /**
     * 返回正常用户数据
     * @param $id
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getNormalUserByUsername($username)
    {
        $user = $this->userObj->getUserByUsername($username);
        if (!$user || $user->status != config('status.mysql.table_normal')) {
            return [];
        }
        return $user->toArray();
    }

    public function update($id, $data)
    {
        //检查用户是否存在
        $user = $this->getNormalUserById($id);
        if(!$user){
            throw new \think\Exception('userid is not exist');
        }
        //检查用户名是否存在
        $userResult = $this->getNormalUserByUsername($data['username']);
        if ($userResult && $userResult['id'] != $id) {
            throw new \think\Exception('username is exist');
        }
        return $this->userObj->updateById($id, $data);
    }
}
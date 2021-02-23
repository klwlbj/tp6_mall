<?php

namespace app\common\model\mysql;

use think\Model;

class User extends Model
{
    /*
     * 自动写入时间
     */
    protected $autoWriteTimestamp = true;

    public function getUsernameByPhoneNumber($phoneNumber)
    {
        if (empty($phoneNumber)) {
            return false;
        }
        $where = [
            'phone_number' => trim($phoneNumber)
        ];
        return $this->where($where)->find();
    }

    public function updateByPhoneNumber($phoneNumber, $data)
    {
        if (empty($phoneNumber) || !is_array($data) || $data == array()) {
            return false;
        }
        $where = array('phone_number' => $phoneNumber);
        return $this->where($where)->save($data);
    }

    public function updateById($id, $data)
    {
        $id = intval($id);
        if (empty($id) || empty($id) || !is_array($data)) {
            return false;
        }
        return $this->where(array('id' => $id))->save($data);
    }

    /**
     * 通过id获取用户数据
     * @param $id
     * @return array|false|Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getUserById($id)
    {
        $id = intval($id);
        if (!$id) {
            return false;
        }
        return $this->find($id);
    }

    /**
     * 通过username获取用户数据
     * @param $id
     * @return array|false|Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getUserByUsername($username)
    {
        if (empty($username)) {
            return false;
        }
        return $this->where(array('username' => $username))->find();
    }


}

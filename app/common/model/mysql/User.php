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
    public function updateByPhoneNumber($phoneNumber, $data){
        if(empty($phoneNumber) || !is_array($data) || $data == array()){
            return false;
        }
        $where = array('phone_number' => $phoneNumber);
        return $this->where($where)->save($data);
    }






}

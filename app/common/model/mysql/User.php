<?php

namespace app\common\model\mysql;

use think\Model;

class User extends Model
{
    protected $autoWriteTimestamp = true;
    public function getUsernameByPhoneNumber($phoneNumber)
    {
        if (empty($phoneNumber)) {
            return false;
        }
        $where = [
            '$phone_number' => trim($phoneNumber)
        ];
        return $this->where($where)->find();
    }
    public function updateById($id, $data){
        if(empty($id) || !is_array($data) || $data == array()){
            return false;
        }
        $where = array('id' => $id);
        return $this->where($where)->save($data);
    }






}

<?php

namespace app\common\model\mysql;

use think\Model;

class AdminUser extends Model
{
    public function getAdminUsernameByUsername($username)
    {
        if (empty($username)) {
            return false;
        }
        $where = ['username' => trim($username)];
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

<?php

namespace app\common\model\mysql;

use think\Model;

class AdminUser extends Model
{
    public function getAdminUsername($username)
    {
        if (empty($username)) {
            return false;
        }
        $where = ['username' => trim($username)];
        return $this->where($where)->find();
    }
}

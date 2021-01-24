<?php


namespace app\admin\business;
use \app\common\model\mysql\AdminUser as model;

class AdminUser
{
    public static function login($data){
        extract($data);
        try{

            $adminUser = self::getAdminUserByUsername($username);
            if(empty($adminUser)){
                show(config('status.error'),'error username');
            }
            if($adminUser['password'] != self::password_md5($password)){
                return show(config('status.error'),'error password');
            }
            $adminUserObj = new model();
            $res = $adminUserObj->updateById($adminUser['id'],array(
                'last_login_ip' => request()->ip(),
                'last_login_time' => time(),
                'update_time' => time(),
            ));
            if(empty($res)){
                return show(config('status.error'),'error login');

            }
        }catch (\Exception $e){
            //$e->message 记录日志
            return show(config('status.error'),'exception login');

        }
        session(config('admin.session_admin'),$adminUser);
        return show(config('status.success'), 'success');
    }
    public static function password_md5($password='klwbj'){
        return md5($password.'klwlbj');
    }
    public static function getAdminUserByUsername($username){
        $adminUserObj = new model();
        $adminUser = $adminUserObj->getAdminUsernameByUsername($username);
        // halt($adminUser);
        if($adminUser == array() || $adminUser['status'] != config("status.mysql.table_normal")){
            return false;

        }
        $adminUser = $adminUser->toArray();
        return $adminUser;
    }

}
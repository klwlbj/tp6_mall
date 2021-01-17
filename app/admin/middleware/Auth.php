<?php
/**
 * Created by PhpStorm.
 * User: sikwansing
 * Date: 2021/1/17
 * Time: 17:16
 */

namespace app\admin\middleware;


class Auth
{
    public function handle($request, \Closure $next){
        //前置
        $islogin = preg_match("/login/",$request->pathinfo());
        $isverify = preg_match("/verify/",$request->pathinfo());
        if(empty(session(config('admin.session_admin'))) && !$islogin && !$isverify){
            return redirect(url('login/index'));
        }
        $response = $next($request);

        //后置中间边可获取到控制器等 (没用)
        /*if(empty(session(config('admin.session_admin'))) && $request->controller() != 'Login' && $request->controller() != 'Verify'){
            return redirect(url('login/index'));
        }*/
        return $response;
    }
    public function end(\think\Response $response)
    {
        // 回调行为
    }
}
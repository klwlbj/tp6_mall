<?php

// namespace app\api\route;
use think\facade\Route;

Route::rule('smscode', 'sms/code', 'post');
Route::rule('login1', 'login/index', 'post');
Route::resource('user','User'); //restful
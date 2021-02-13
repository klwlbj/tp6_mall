<?php
use app\ExceptionHandle;
use app\Request;

// 容器Provider定义文件
return [
    // 'think\exception\Handle' => \app\api\exception\Http::class,
    'think\exception\Handle' => "\\app\\api\\exception\\Http",
];

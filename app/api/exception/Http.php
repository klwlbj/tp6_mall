<?php


namespace app\api\exception;

use think\Exception;
use think\exception\Handle;
use think\Response;
use Throwable;

class Http extends Handle
{
    public $httpStatus = 500;

    public function render($request, Throwable $e): Response
    {
        if($e instanceof Exception){
            return show($e->getCode(), $e->getMessage());
        }
        if (method_exists($e, 'getStatusCode')) {
            $httpStatus = $e->getStatusCode();
        } else {
            $httpStatus = $this->httpStatus;
        }
        // 添加自定义异常处理机制
        return show(config('status.error'), $e->getMessage(), [], $httpStatus);
    }
}
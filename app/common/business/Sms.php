<?php
declare(strict_types=1);

namespace app\common\business;

use app\common\lib\ClassArr;
use app\common\lib\Num;
// use app\common\lib\sms\AliSms;

class Sms
{
    public static function sendCode(string $phoneNumber, int $len, string $type = 'ali'): bool
    {
        // 生成验证码 4 or 6
        $code = Num::getCode($len);
        /*// 工厂模式
        $type = ucfirst($type);
        $class = "app\common\libs\sms\\".$type."Sms"; // 拼接class
        $smsRet = $class::sendCaptcha($phoneNumber, $code);*/
        $classStats = ClassArr::smsClassStat();
        $classObj = ClassArr::initClass($type, $classStats, [], false);
        $smsRet = $classObj::sendCode($phoneNumber, $code);
        // $smsRet = true;
        if ($smsRet) {
            // 验证码记录到redis中，1分钟后失效
            cache(config('redis.code_pre') . $phoneNumber, $code, config('redis.code_expire'));
        }
        return $smsRet;
    }
}
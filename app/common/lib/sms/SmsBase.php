<?php
declare(strict_types=1);

namespace app\common\lib\sms;


interface SmsBase
{
    public static function sendCaptcha(string $phone, int $code);
}
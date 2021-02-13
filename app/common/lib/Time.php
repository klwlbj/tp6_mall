<?php


namespace app\common\lib;


class Time
{
    public static function userLoginExpiresTime($type = 2)
    {
        $day = $type == 2 ? 30 : 7;
        return $day * 24 * 3600;
    }
}
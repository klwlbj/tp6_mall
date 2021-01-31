<?php

/**
 * 记录和数据相关的类库方法
 */
declare(strict_types=1);

namespace app\common\lib;


class Num
{
    public static function getCode(int $len = 4): int
    {
        $code = $len == 4 ? rand(1000, 9999) : rand(100000, 999999);
        return $code;
    }
}
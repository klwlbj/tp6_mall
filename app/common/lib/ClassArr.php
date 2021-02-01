<?php


namespace app\common\lib;


class ClassArr
{
    public static function smsClassStat()
    {
        return array(
            'ali' => "app\common\libs\sms\Alisms",
        );
    }

    public static function initClass($type, $class, $params = array(), $needInstance = false)
    {
        // 静态模式 返回类库
        // 非静态模式，返回对象
        if (!array_key_exists($type, $class)) {
            return false;
        }
        $className = $class[$type];
        // 反射机制 -> 实例化
        return $needInstance ? (new \ReflectionClass($className))->newInstance($params) : $className;
    }
}
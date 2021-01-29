<?php
declare(strict_types=1);
namespace app\api\controller;
use app\BaseController;
class Sms
{
    public function code(){
        return show(config('status.succes'), "ok");
    }
}
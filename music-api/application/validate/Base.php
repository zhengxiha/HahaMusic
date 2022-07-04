<?php

namespace app\validate;

use app\exception\ParamErrorException;
use think\facade\Request;
use think\Validate;

class Base extends Validate
{
    public function toCheck($scene = '') {

        $param = Request::instance()->param();
        $result = $this->scene($scene)->batch()->check($param);

        if(!$result) {
            return $this->getError();
           
        }
    }
}
<?php

namespace app\model;

use think\Model;

/**
 * 所有模型的基类
 */
class Base extends Model
{
    public function getUrl($value, $data)
    {
        
        return config('songlist.songlistpicUrl') . $value;   
    }
}
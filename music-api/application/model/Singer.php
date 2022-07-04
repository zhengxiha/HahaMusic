<?php

namespace app\model;

use think\Model;

class Singer extends Base
{
    protected $pk = 'singerId';
   public function getSingerImgAttr($value,$data){
       return config('songlist.songlistpicUrl').$value;
   }  
//    获取指定歌手的歌曲列表
   public function getSingersongs()
    {
        return $this->hasMany('Song');
    }
}
<?php

namespace app\model;

use think\Model;

class Song extends Base
{
    protected $pk = 'songId';
    
   public function getSongImgAttr($value,$data){
       return config('songlist.songlistpicUrl').$value;
   }

   public function getSongUrlAttr($value,$data){
    return config('songlist.songlistpicUrl').$value;
    }

    // 歌曲-评论 一对多
    public function getsongComments(){
        return $this->hasMany('Comment');
    }

    // 搜索
    public function searchSong($keyword){
        
        
    }
}
<?php

namespace app\api\controller;
use app\model\Singer as SingerModel;
class Singer extends Base
{
    // 获取歌手版面歌单
    public function getsinger()
    {
        $data=(new SingerModel())->select();
        return ['code'=>200,
        'data'=>$data 
        ];
    }
    // 获取指定歌手的歌曲列表
    public function getsingerSongs($singerId){
        $list= SingerModel::get($singerId);
        $singersong=$list->getSingersongs;
        return ['code'=>200,
        'data'=>$singersong 
        ];
    }
   
}
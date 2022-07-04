<?php

namespace app\api\controller;
use app\model\Songlist as SonglistModel;
class Songlist extends Base
{   
     // 获取首页歌单
     public function getSongListtop()
     {
        // $data=UserModel::field('id,username,email')->find($id);
         $data=(new SonglistModel())->limit(10)->select();
         return ['code'=>200,
         'data'=>$data
         ];
     }

    // 获取全部歌单
    public function getSongList()
    {
        $data=(new SonglistModel())->select();
        return ['code'=>200,
        'data'=>$data
        ];
    }
    // 获取指定歌单ID的歌曲
    public function getList($songlistId){
        $list= SonglistModel::get($songlistId);
        // $data=$data->selectListsong();
        $songlist=$list->selectListsong;
        
        return ['code'=>200,
        'data'=>$songlist
    ];
        
    }
}

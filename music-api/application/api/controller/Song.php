<?php

namespace app\api\controller;
use app\model\Song as SongModel;
use app\model\User as UserModel;
use think\Collection;
use think\db;

class Song extends Base
{
    // 获取首页推荐歌单
    public function getSongInfo()
    {
        $data=(new SongModel())->select();
        // $data=(new SongModel())->limit(10);
        return ['code'=>200,
        'data'=>$data 
        ];
    }
    // 获取指定歌曲的评论
    public function getsongComment($songId)
    {
        // $list= SongModel::get($songId);
        // $songcomments=$list->getsongComments;
        
        // return ['code'=>200,
        // 'data'=>$songcomments 
        // // 'data'=>$result
        // ];
        Db::name('user')->withAttr('avator',function($value,$data){
            return config('user.faceImageUrlPrefix').$value;
        })->select();
        $list=Db::table('song')
        ->alias('s')
        ->join('comment c','s.songId=c.song_id')
        ->join('user u','u.userId=c.user_id')
        ->field('c.commentId,c.content,c.date,u.userName,u.avator')
        ->where('s.songId','=',$songId)
        ->order('date desc')
        ->select();
        // $list['avator']=config('user.faceImageUrlPrefix')->;
        // config('user.faceImageUrlPrefix').$list->avator;
        return ['code'=>200,
                'data'=>$list
        // 'data'=>$result
        ];

    }

    // 搜索歌曲或歌手返回歌曲列表
    public function search($keyword)
    {
        // Db写法： 这样写不能访问到模型里的修改器，即取到的图片地址是数据库里的原有数据，未加前缀
        // $list=Db::table('song')
        // ->whereOr('songName','like',"%".$keyword."%")
        // ->whereOr('singer','like',"%".$keyword."%")->select();

        // 模型写法
        $where[]=['songName|singer','like',"%".$keyword."%"];
        $list=SongModel::where($where)->select();
        return ['code'=>200,
        'data'=>$list 
        // 'data'=>$result
        ];
    }
}
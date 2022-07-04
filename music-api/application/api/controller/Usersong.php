<?php
namespace app\api\controller;
use app\model\Usersong as UsersongModel;
use app\model\Usersonglist as UsersonglistModel;
use think\Request;

Class Usersong extends Base{
    //用户新增收藏歌曲
    public function createUsersong(Request $request)
    {          
    $data=$request->param();
    // $usersong = (new UsersongModel)->createOne();
        
    $result=(new UsersongModel)->where(['user_id' => $data['user_id']])->where(['song_id' => $data['song_id']])->select();
    if($result->isEmpty()){
        $usersong = (new UsersongModel)->createOne();
        $message='收藏成功';
    }else{
        (new UsersongModel)->where(['user_id' => $data['user_id']])->where(['song_id' => $data['song_id']])->delete();
        $message='取消收藏成功';
    }
        return [
            'code'=>200,
            'data'=>$message
        ];
    }

    //用户新增/取消收藏歌单
    public function createUsersonglist(Request $request)
    {          
    $data=$request->param();
    
    $result=(new UsersonglistModel)->where(['user_id' => $data['user_id']])->where(['songlist_id' => $data['songlist_id']])->select();
    if($result->isEmpty()){
        $usersonglist = (new UsersonglistModel)->createOne();
        $message='收藏成功';
    }else{
        (new UsersonglistModel)->where(['user_id' => $data['user_id']])->where(['songlist_id' => $data['songlist_id']])->delete();
        $message='取消收藏成功';
    }
   
        
        return [
            'code'=>200,
            // 'data'=>$usersonglist
            'data'=>$message
            // 'data'=>$result
        ];
    }


}
<?php

namespace app\api\controller;
use app\model\Comment as CommentModel;
use think\Request;
class Comment extends Base
{
    // 获取用户id及歌曲id插入一条评论
    public function createComment(Request $request){
        //获取数据
    $data=$request->param();
    // 写入数据库
    $Comment = (new CommentModel)->createOne();
        
        return [
            'code'=>200,
            'data'=>$Comment
        ];
    }
}
<?php
namespace app\model;
use think\facade\Request;//静态调用请求对象的引入类
Class Comment extends Base{
    protected $pk = 'commentId';
    

    // 插入一条评论
    public function createOne()
    {
        $params = Request::only(['user_id', 'song_id','content']);
        // $params['user_id']=$userId;
        // $params['song_id']=$songId;
        $params['date']=date('Y-m-d H:i');
        $result = self::create($params);
        return $result;
    }
    
}
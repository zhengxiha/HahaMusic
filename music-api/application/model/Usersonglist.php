<?php
namespace app\model;
use think\facade\Request;//静态调用请求对象的引入类
use think\model\Pivot;

Class Usersonglist extends Pivot
{
    protected $pk = 'uSonglistId';
    
    // 插入用户收藏的歌曲
    public function createOne()
    {
        $params = Request::only(['user_id','songlist_id']);
        $result = self::create($params);
        return $result;
    }

}
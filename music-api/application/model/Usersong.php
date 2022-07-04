<?php
namespace app\model;
use think\facade\Request;//静态调用请求对象的引入类
use think\model\Pivot;

Class Usersong extends Pivot
{
    protected $pk = 'uSongid';
    
    // 插入用户收藏的歌曲
    public function createOne()
    {
        $params = Request::only(['user_id','song_id']);
        $result = self::create($params);
        return $result;
    }

}
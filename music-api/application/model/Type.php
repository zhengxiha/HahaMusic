<?php
namespace app\model;

use think\Model;
use think\facade\Request;//静态调用请求对象的引入类

class Type extends Model
{
    protected $pk = 'typeId';
    public function getinfo(){
        $params = Request::only(['Type', 'typeName']);
        $result=self::create($params);
        if(!$result) {
            throw new Exception('注册字段写入数据库失败');
        }
        return $params;
    }
    // 分类-歌曲 一对多
    public function getTypelist(){
        return $this->hasMany('Songlist');
    }
    
}
<?php
namespace app\model;

// use app\validate\Base;
use think\Model;
use think\facade\Request;//静态调用请求对象的引入类


class Songlist extends Base
{
    protected $pk = 'songlistId';
    // static function selectSonglist() {
    //     $field=[    //字段
    //         'songlistId',
    //         'title',
    //         'url'
    //     ];
    //     //将要查询的值传入，在表中的userName字段查询对应值
    //     $data = self::field($field)->select();
    //     $data['url']=getUrlAttr($data['url'],$data);
    //     // $data['songlistImg']=config('songlist.songlistpicUrl')+$data['songlistImg'];
    //     return $data;     
    //     // $params = Request::only(['songlistId', 'title','songlistImg']);    
    //     // $data = self::field($params)->select();  
    //     // return $data; 
    // }
    
    // protected $hidden = ['songlistId', 'title', 'introduction','type_id'];

    public function getUrlAttr($value,$data){
        $finalURL = $value;
        //如果from的字段为1，表示是本地资源，需要加上前缀
        //from字段不是1，表示是网络资源，直接返回网络地址就可以了。
       
            $finalURL =config('songlist.songlistpicUrl').$value;
        return $finalURL;
    }

    // 返回指定歌单Id的歌曲列表   歌单-歌曲 多对多
    public function selectListsong()
    {
        return $this->belongsToMany('Song','\\app\\model\\Songandlist');
    }
}
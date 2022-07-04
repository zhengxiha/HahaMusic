<?php
namespace app\api\controller;
use think\facade\Config;
use think\facade\Request;
use think\Response;


abstract class Base{
    protected $page;
    protected $pageSize;
    public function __construct()
    {
        // $this->page = (int)Request::param('page');
        //$this->pageSize =(int)Request::param('page_size');//这个显示方法错误是因为引入的是think/Request,这个要用-> 不能用::
        //获取分页
        $this->page = (int)Request::param('page');
        //获取条数
        // $this->pageSize =(int)Request()->param('page_size',Config->get('app.page_size'));
        $this->pageSize =(int)Request::param('page_size',Config::get('app.page_size'));
    }
    // protected function create($data,string $msg='', int $code=200,string $type='json'):Response

    //api数据返回标准
    protected function create($data,string $msg='',int $code=200,$type='json')
    {
        $result=[
            'code' => $code,
            'msg'  => $msg,
            'data' => $data
        ];
        return Response::create($result,$type);
    }
    
    public function __call($name, $arguments)
    {
        //404,方法不存在的错误
        return $this->create([],'方法不存在',404);
    }

}
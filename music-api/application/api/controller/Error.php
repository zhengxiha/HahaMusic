<?php
namespace app\api\controller;

class Error extends Base
{
    // public function index(Request $request)
    // {
    //     return [404,'没有这个控制器吧->->'.$request->controller().'controller'];
    // }

    // public function _empty($func)
    // {
    //     return [400,'没有这样的方法嘞:'.$func];
    // }

    // public function initialize()
    // {
    //     header("Access-Control-Allow-Origin:*");
    // }

    //404 如果访问存在的控制器，则提示资源不存在
    // @return \think\Response
    public function index(){
        return $this->create([],'没有这个控制器!!',404); 
    }


}
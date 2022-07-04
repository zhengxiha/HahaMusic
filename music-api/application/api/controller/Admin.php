<?php
namespace app\api\controller;
use app\model\Admin as AdminModel;
use think\Controller;

class Admin extends Controller
{
    public function getsonglist(){
        $data=AdminModel::select();
        $total=$data->count();  //数据条数
        return [200,['total' =>$total,'data' => $data]];
    }

}
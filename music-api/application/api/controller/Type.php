<?php
namespace app\api\controller;
use app\model\Type as TypeModel;
use think\Controller;
use think\db;

class Type
{
    public function getinfo()
    {
        $data=  (new TypeModel)->getinfo();
       
        return [200, ['data' => $data]];
    }

    public function getTypelists($typeId){
        $list= TypeModel::get($typeId);
        // $data=$data->selectListsong();
        $songlist=$list->getTypelist;
        return ['code'=>200,
        'data'=>$songlist
    ];


    }
}
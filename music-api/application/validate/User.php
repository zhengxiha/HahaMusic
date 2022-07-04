<?php

namespace app\validate;

use think\Validate;
use app\Validate\Base;
class User extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [  
        'userId'  => 'require|max:25',
        'userName' => 'require',
        'password'   => 'require|number',    
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [
        'userId.require' => '账号不能为空!',
        'userName.require'=>'用户名不能为空！',
        'password.require'=> '密码不能为空',
   
    ];

    // 写场景的话场景名要小写
    protected $scene = [
        'register'  =>  ['userId','userName','password'],
        'login'=>['userId','password']
    ];
    
}

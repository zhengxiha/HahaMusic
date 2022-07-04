<?php
namespace app\model;

use think\Model;
use think\facade\Request;//静态调用请求对象的引入类


class User extends Model
{
    //用静态方法
    static function selectOne1($userId) {
        // $field=[    //字段
        //     'userId',
        //     'userName'
        // ];
        //将要查询的值传入，在表中的userName字段查询对应值
        // $user = self::field($field)->where('userName','=',$userId)->select();
        $user = self::where('userId','=',$userId)->select();
        return $user;           
    }

    public function getinfo(){
        $params = Request::only(['username', 'account']);
        $result=self::create($params);
        if(!$result) {
            throw new Exception('注册字段写入数据库失败');
        }
        return $params;
    }
/************管理系统*********************/
    static function selectUserInfo(){
        $field=[    //字段
            'userid',
            'account',
            'username',
            'sex',
            'email',
            'phone',
            'registerdate'

        ];
        //将要查询的值传入，在表中的userName字段查询对应值
        $user = self::field($field)->select();
        return $user;           
    }



    // /-------------------------用户接口------------
    //注册添加用户数据
    protected $pk = 'userId';
    // protected $autoWriteTimestamp = true;
    // 开启自动写入时间戳字段
    //字段名默认创建时间字段为create_time，更新时间字段为update_time，支持的字段类型包括timestamp/datetime/int
    protected $autoWriteTimestamp = 'datetime';
    protected $dateFormat = 'Y-m-d H:i:s';
// ===注册新增用户
    public function createOne() {
    $params = Request::only(['userId', 'userName','password']);
    $params['password'] = md5($params['password']);
    $params['create_time']=date('Y-m-d');
    $params['registrationTime']=date('Y-m-d');
    $params['avator']='user.jpg';
    // $params['avator']='';
    $result = self::create($params);
    return $result;
    }
// ===登陆
    public function selectOne() {
    $params = Request::only(['userId', 'password']);
    $params['password'] = md5($params['password']);
    return self::where(['userId' => $params['userId']])
            ->where(['password' => $params['password']])
            ->find();
}

// 修改密码
    public function changePassword()
    {
        $params = Request::only(['userId', 'npassword']);
        $params['npassword'] = md5($params['npassword']);
        self::save(['password'=>$params['npassword']],
                    ['userId'=>$params['userId']]);
       
    }

    // 用户头像更新
    public function updateAvator($fileName){
        $params = Request::only(['userId']);
        self::save(['avator'=>$fileName],['userId'=>$params['userId']]);
    }
    // 用户信息更新
    public function updateInfo()
    {
        $params = Request::only(['userId','userName','sex','birth','phone','email','sign']);
        $params['birth']=date('Y-m-d');
        self::save([
                    'userName'=>$params['userName'],
                    'sex'=>$params['sex'],
                    'birth'=>$params['birth'],
                    'phone'=>$params['phone'],
                    'email'=>$params['email'],
                    'sign'=>$params['sign']
                ], ['userId'=>$params['userId']]);
        
    }
    // 用户和歌曲 多对多
    public function selectUsersong()
    {
        return $this->belongsToMany('Song','\\app\\model\\Usersong');
    }
    // 用户和歌单 多对多
    public function selectUsersonglist()
    {
        return $this->belongsToMany('Songlist','\\app\\model\\Usersonglist');
    }

    // 用户-评论 一对多
    public function getsongComments(){
        return $this->hasMany('Comment');
    }


    //用静态方法
    static function selectUser($userId) {
        // $field=[    //字段
        //     'userId',
        //     'userName'
        // ];
        //将要查询的值传入，在表中的userName字段查询对应值
        // $user = self::field($field)->where('userId','=',$userId)->select();
        $user = self::where('userId','=',$userId)->find();
        return $user;           
    }
}
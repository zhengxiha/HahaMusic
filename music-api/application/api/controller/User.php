<?php
declare (strict_types=1);
namespace app\api\controller;
use app\model\User as UserModel;
use think\exception\ValidateException;
//引入request
use think\Request;
use think\facade\Validate;
use app\validate\User as UserValidate;
use app\service\UserToken;

class User extends Base
{
    public function Index()
    {
  
    $data =UserModel::field('userid,username')->page($this->page,$this->pageSize)->select();
    if($data->isEmpty()){
        return $this->create([],'无数据',204);
    } else{
        return $this->create($data,'数据请求成功',200); 
    }
    }
    
/*    
// 显示指定的资源
// @param int $id
// @retrun \think\Response*/

//单一数据api
public function read($id){

    //判断id是否整型
    if(!Validate::isInteger($id)){
        return $this->create([],'id参数不合法!',400);
    }
    //获取数据
    // $data=UserModel::field('userid,username,email')->where('userid','=',$id)->find();//已将表user的userId改为id 
    $data=UserModel::field('id,username,email')->find($id);
    
  //判断是否有值
    if(empty($data)){
        return $this->create([],'无数据',204);
    } else{
        return $this->create($data,'数据请求成功',200); 
    }
   
}
//验证后添加数据
//-------------post请求  body中form-data方式测试----------
//开发文档里比较详细准确
public function save(Request $request){
    //获取数据
    $data=$request->param();

    //验证返回
        $validate = new \app\validate\User;

        if (!$validate->check($data)) {
            return $validate->getError();
        }
       
    //密码
    $data['password']=md5($data['password']);
    $id=UserModel::create($data)->getData('id');
    //判断是否有值
    if(empty($id)){
        return $this->create([],'注册失败',204);
    } else{
        return $this->create($data,'注册成功',200); 
    }
   


}

//删除一条数据
    public function delete($id)
    {
    //判断id是否整型
    if(!Validate::isInteger($id)){
        return $this->create([],'id参数不合法!',400);
    }
    $userId=$id;
    //删除
    try{
        UserModel::find($id)->delete();
        return $this->create([],'删除成功',20);
    }catch(\Error $e){
        return $this ->create([],'错误或无法删除!',400);
    }
     
    }

//修改数据 
    public function update(Request $request,$id)
    {
        $date=$request->put();
        // dd($data);
        // echo 'update';
    }

/****************************1* */
    public function selectone1()
    {
       $data = UserModel::selectOne1('王明');
       $total=$data->count();  //数据条数
       
        return [200, ['total' =>$total,'data' => $data]];
    }

    public function getinfo()
    {
        $data=  (new UserModel)->getinfo();
       
        return [200, ['data' => $data]];

    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }
//------------------------------------------------
/*************管理系统api *********************/

    public function getUserList(){
        $data = UserModel::selectUserInfo();
        $total=$data->count();  //数据条数
        return [200, ['total' =>$total,'data' => $data]];
    }

 

//注册接口---------------------
    public function Register(Request $request){
    //获取数据
    $data=$request->param();
    //验证返回
        $validate = new \app\validate\User;
        if (!$validate->check($data)) {
            return $validate->getError();
        }
    // 写入数据库
        $user = (new UserModel)->createOne();
    // 判断是否有值
    if(empty($user)){
        return $this->create([],'注册失败',204);
    } 
    // 生成token令牌
    $token = (new UserToken())->get($user);
    // 返回数据
    return ['code'=>200,
            'token'=>$token,
            'data'=>[
                'userId'=> $user->userId,
                'userName' => $user->userName,
                'avator'=>config('user.faceImageUrlPrefix').$user->avator,
            ]
        ];
        // return $this->create($data,'注册成功',200); 
    }
    // 登陆
    public function Login(Request $request){
            //获取数据
    $data=$request->param();
    //验证返回
        $validate = new \app\validate\User;
        if (!$validate->scene('login')->check($data)) {
            return $validate->getError();
        }
    // 从数据库中查询对应账号
    $user = (new userModel())->selectOne($data);
    // 如果不存在
    if(!$user) {
        return "该用户不存在";
    }
    $token = (new UserToken)->get($user);
    return ['code'=>200,
            'token'=>$token,
            'data'=>[
                'userId'=> $user->userId,
                'userName' => $user->userName,
                'avator'=>config('user.faceImageUrlPrefix').$user->avator,
            ]
        ];
    }
    // 修改密码
    public function changePassword(Request $request){
        //获取数据
        $data=$request->param();

        $pwd=md5($data['password']);
        $result=UserModel::where('userId','=',$data['userId'])->find();
        if($pwd==$result['password']){
            (new userModel())->changePassword();
            return ['code'=>200,
                    'message'=>"密码修改成功！"
            ];
        }else{
            return ['code'=>401,
                    'message'=>"密码错误，请输入正确的密码！"
            ];
        }
        // return ['code'=>200,
        //             'message'=>"密码修改成功！"
        //     ];

    }

    // 获取用户收藏歌曲
    public function getUsersong($userId){
        $list= userModel::get($userId);
        // $data=$data->selectListsong();
        $usersonglist=$list->selectUsersong;
        return ['code'=>200,
        'data'=>$usersonglist
    ];
    }

     // 获取用户收藏歌单
     public function getUsersonglist($userId){
        $list= userModel::get($userId);
        // $data=$data->selectListsong();
        $usersonglist=$list->selectUsersonglist;
        return ['code'=>200,
        'data'=>$usersonglist
    ];
    }
    // 返回用户信息
    public function getUserinfo($userId){
      
        $list=UserModel::selectUser($userId);
        return ['code'=>200,
        'data'=>$list
        ];
    }
    // 用户信息修改
    public function updateUser(Request $request){
        //获取数据
        $data=$request->param();
         (new UserModel)->updateInfo();
         $user =UserModel::where('userId','=',$data['userId'])->find();
        return ['code'=>200,
        'data'=>$user
        ];
    }


    // 用户头像上传
    public function uploadAvator(){
        $file=request()->file('image');
        $urlPrefix=config('user.faceImageUrlPrefix');
      
        // 将上传的图片放到api的uploads/face下
        $info=$file->move('./uploads/face/','');
        $fileName='';
        if($info){
            // 获取图片名
            // $fileName=$info->getFilename();
            $fileName=$info->getSaveName();
            (new UserModel())->updateAvator($fileName);
        }else{
            echo $file->getError();
        }
        
        return ['code'=>200,
        'data'=>[
            'avator'=>$urlPrefix.$fileName
        ]];
        // return "jjj";
    }
}
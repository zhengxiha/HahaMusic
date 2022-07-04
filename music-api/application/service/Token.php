<?php
namespace app\service;

class Token {
    //生成token字符串
    public static function generateToken()
    {
        // /32个字符组成一组随机字符串 三种随机字符串的md5加密
        $randChar = getRandChars(32);
        $rTime = $_SERVER["REQUEST_TIME"];
        $salt = config('token.salt');
         //用三组字符串，进行md5加密
        return md5($randChar.$rTime.$salt);
    }

    public function saveToCatch($value){
        $key = $this->generateToken();
        $value = json_encode($value);
        $expire = config('token.token_expire_in');

        $result = cache($key,$value,$expire);
        if(!$result){
            echo '缓存生成失败';
        }
        return $key;
    }
}

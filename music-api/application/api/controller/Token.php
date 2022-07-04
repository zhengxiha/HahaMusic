<?php
namespace app\api\controller;
use app\api\service\UserToken;
use app\api\validate\TokenGet;
class Token {
    /**
     * 用户获取令牌（登陆）
     * @url /token/user
     * @POST code
     */
    public function getToken($code = '') {
        // 验证token
        (new TokenGet())->goCheck();
        $wx = new UserToken($code);
        $token = $wx->get();
        return [
            'token' => $token
        ];

    }
}

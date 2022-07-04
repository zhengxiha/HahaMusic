<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件


// 生成随机字符串
function getRandChars($length)
{
    $str = 'QWERTYUIOPASDFGHJKLMNBVXZCqwetryuioplkjhgfdaszxcvbnm09876543123';
    $strLength = count((array)$str) - 1;
    $result = '';

    for($i=0; $i<$length; $i++){
        $result.= $str[rand(0,$strLength)];
    }
    return $result;
}

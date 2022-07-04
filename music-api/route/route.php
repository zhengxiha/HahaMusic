<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// use think\facade\Route;

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

// Route::get('test$', 'api/user/index');
// Route::get('test/:id$', 'api/user/read');

Route::get('getuserlist', 'api/user/getUserList');

// Route::resource('user', 'api/user');
Route::resource('admin', 'api/admin');

// ==============用户接口
Route::post('user/register', 'api/user/register');
Route::post('user/login', 'api/user/login');
// 用户信息
Route::get('getUserinfo', 'api/user/getUserinfo');
// 更改头像
Route::post('uploadAvator', 'api/user/uploadAvator');
// 更新用户信息
Route::post('updateUser', 'api/user/updateUser');
// 修改密码
Route::post('changePassword', 'api/user/changePassword');


// ===========歌单
Route::get('songlisttop', 'api/songlist/getsongListtop');
Route::get('songlist', 'api/songlist/getsonglist');
// 指定歌单id的歌曲列表
Route::get('list', 'api/songlist/getList');

// =========歌曲 
// 获取歌曲信息
Route::get('song', 'api/song/getSongInfo');
// 获取指定歌曲评论
Route::get('songcomments', 'api/song/getsongComment');
// 添加指定歌曲评论
Route::post('createcomments', 'api/comment/createComment');


//=========== 歌手
// 歌手版面的歌单
Route::get('singer', 'api/singer/getsinger');
// 指定歌手的歌曲列表
Route::get('singersongs', 'api/singer/getsingerSongs');


// ==========用户收藏歌曲
// 新增收藏歌曲
Route::post('createUsersong', 'api/usersong/createUsersong');
// 新增收藏歌单
Route::post('createUsersonglist', 'api/usersong/createUsersonglist');
// 获取用户收藏歌曲列表
Route::get('getUsersong', 'api/user/getUsersong');
// 获取用户收藏歌单列表
Route::get('getUsersonglist', 'api/user/getUsersonglist');

// =============搜索
Route::post('search', 'api/song/search');

// 获取歌单分类
Route::get('getTypelists', 'api/type/getTypelists');


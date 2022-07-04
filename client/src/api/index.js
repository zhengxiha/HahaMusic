import {get, post } from './request'
/*************** */
const HttpManager = {
    // =======================> 用户 
    // 登录
    loginIn: (params) => post(`user/login`, params),
    register: (params) => post(`user/register`, params),
    // 获取用户信息
    getUserinfo: (userId) => get(`getUserinfo?userId=${userId}`),
    // 更改头像  
    uploadAvator: (params) => post(`uploadavator`, params),
    // 修改密码
    changePassword: (params) => post(`changePassword`, params),
    // 修改用户信息
    updateUser: (params) => post(`updateUser`, params),

    // =====================用户收藏歌单、歌曲
    getmySongList: (userId) => get(`getUsersonglist?userId=${userId}`),
    getmySong: (userId) => get(`getUsersong?userId=${userId}`),
    // 提交收藏的歌单、歌曲
    collectionSonglist: (params) => post(`createUsersonglist`, params),
    collectionSong: (params) => post(`createUsersong`, params),


    // ==========================>歌单
    //获取首页歌单
    getSongListtop: () => get('songlisttop'),
    // 获取全部歌单
    getSongList: () => get('songList'),
    // 获取歌单类型
    getTypelists: (typeId) => get(`getTypelists?typeId=${typeId}`),

    // ==============================>歌曲 
    //    返回指定ID的歌曲
    getListSongOfSongId: (songListId) => get(`list?songlistId=${songListId}`),
    // 返回指定歌曲评论
    getSongcomment: (songId) => get(`songcomments?songId=${songId}`),
    // 提单评论
    commentTosong: (params) => post(`createcomments`, params),


    // ===============================>歌手
    // 获取所有歌手
    getSingerList: () => get('singer'),
    // 获取指定歌手歌曲
    getSingersongs: (singerId) => get(`/singersongs?singerId=${singerId}`),

    // =============================搜索
    songSearch: (params) => post(`search`, params)
}

export { HttpManager }
/*******************************8 */
import Vue from 'vue'
import Vuex from 'vuex'
import Router from 'vue-router'
import HelloWorld from '@/components/HelloWorld'

Vue.use(Router)
    // Vue.use(Vuex)
    // export default new Router({
    //   routes: [
    //     {
    //       path: '/',
    //       name: 'HelloWorld',
    //       component: HelloWorld
    //     }
    //   ]
    // })
    //路由设置
const constantRoutes = [{
        path: '/',
        //component: Home
        redirect: '/home', //根重定向到首页
        component: resolve => require(['../components/Main.vue'], resolve),
        children: [{
                path: '/home',
                component: resolve => require(['../pages/home.vue'], resolve),

            },
            {
                path: '/song',
                component: resolve => require(['../pages/Song.vue'], resolve)
            },
            {
                path: '/singer',
                component: resolve => require(['../pages/Singer.vue'], resolve)
            },
            {
                path: '/singerinfo/:id',
                component: resolve => require(['../pages/SingerInfo.vue'], resolve),
            },
            {
                path: '/mymusic',
                component: resolve => require(['../pages/MyMusic.vue'], resolve)
            },
            // 歌曲详情
            {
                path: '/songdetail',
                component: resolve => require(['../pages/SongDetail.vue'], resolve),
            },
            // 歌单列表
            {
                path: '/songlist/:id',
                component: resolve => require(['../pages/SongList.vue'], resolve),
                // name: 'songlist',
                // children: [{
                //         path: ':id',
                //         component: resolve => require(['../pages/SongList.vue'], resolve),
                //     }
                // ]

            },
            {
                path: '/search',
                component: resolve => require(['../pages/Search.vue'], resolve),
            },
            // 个人中心
            {
                path: '/personalcenter',
                component: resolve => require(['../pages/PersonalCenter.vue'], resolve),
            },
        ]
    },

    {
        path: '/login',
        name: 'Login',
        component: resolve => require(['../pages/Login.vue'], resolve)
    },
    {
        path: '/contentnav',
        name: 'ContentNav',
        component: resolve => require(['../components/ContentNav.vue'], resolve),
    },
    {
        path: '/helloworld',
        name: 'HelloWorld',
        component: HelloWorld
    },
]

export default new Router({
    mode: 'history', // 去掉url中的#
    scrollBehavior: (o, from, savedPosition) => ({ x: 0, y: 0 }), //返回页面回到原位置
    routes: constantRoutes

})
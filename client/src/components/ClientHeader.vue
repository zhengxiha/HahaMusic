<template>
  <div class="header">
    <!-- 网站logo -->
    <div class="logo-area">
       <img src="../assets/img/logo.png" alt="" />
    </div>
    <!-- <div class="title">HaHaMusic</div> -->
    <!-- 搜索 -->
    <div class="search">
      <el-input
        placeholder="请输入歌名/歌手"
        class="input-with-select"
        size="medium"
        v-model="keyword"
      >
        <el-button slot="append" icon="el-icon-search" @click="goSearch()" ></el-button>
      </el-input>
    </div>
    <!-- 用户部分 -->
    <div class="header-right">
      <div class="header-user-icon">
        <!-- 用户名 -->
        <span>
          {{ username }}
        </span>
        <!-- 用户头像下拉菜单 -->
        <el-dropdown class="user-name" trigger="click" @command="handleCommand">
          <div class="user-avator">
            <img :src="avator" />
          </div>
          <el-dropdown-menu slot="dropdown">
            <el-dropdown-item command="goPersonalCenter" >个人中心</el-dropdown-item>
            <el-dropdown-item command="loginout">退出登录</el-dropdown-item>
          </el-dropdown-menu>
        </el-dropdown>
      </div>
    </div>
  </div>
</template>

<script>
import mixin from '../mixins'
import { mapGetters } from 'vuex'
import {HttpManager} from "../api/index"
export default {
    mixins: [mixin],
  data() {
    return {
      // username: '',
      keyword:'' //搜索关键字
    };
  },
  computed: {
    ...mapGetters([
      'userId',
      'activeName',
      'avator',
      'username',
      'loginIn',

      'listOfSongs'
    ])
  },
  methods: {
    // 用户头像下拉菜单选择事件
    handleCommand(command) {
      if (command === "loginout") {
        this.$router.push("/login");
        // 退出清除会话存储信息，不知道哪里漏掉了，退出后不刷新歌曲url仍存在
        sessionStorage.clear()
      }else if(command==="goPersonalCenter"){
        this.$router.push({path: `/personalcenter`});
      }
    },
    // 跳转个人中心
     goPersonalCenter(){
      this.$router.push({path: `/personalcenter`})
    },
    // 跳转歌曲搜索结果
    goSearch(){
      this.$router.push({path: `/search`})
      let param = this.searchParams();
      HttpManager.songSearch(param).then((res)=>{
        // console.log("搜索的歌曲：",res.data)
        console.log("搜索的关键字：",param)
        console.log("搜索的歌曲：", res.data)
        //  this.$store.commit('setListOfSongs', res.data)
        this.$store.commit('setListSongs', res.data)
      })
      this.keyword=''
    },
    // 注册参数注入
    searchParams() {
      let param = {
        keyword: this.keyword,
      };
      return param;
    },
  },
  
};
</script>

<style scoped>
.header {
  /* z-index: 100; */
  box-sizing: border-box;
  width: 100%;
  height: 58px;
  color: #000000;
  background: #7058a3;
  box-shadow: 0px 0px 8px 2px rgba(0, 0, 0, 0.3);
  padding:0.52rem
}

.logo-area {
  width: 90px;
  height: 50px;
  display: inline-block;
  float: left;
}

.logo-area img {
  width: 100%;
  
  /* border-radius: 2rem; */
  margin-top: 0.55em;
}
.header-right {
  /* width:20%; */
  position: relative;
  margin-top: -0.55em;
  float: right;
  padding-right: 10px;
}

.header-user-icon {
  display: flex;
  height: 58px;
  align-items: center;
}
.user-name {
  margin-left: 15px;
  font-size: 1.23rem;
}
/* 搜索 */
.search{
  width:30%;
  float: left;
  margin-left:16rem;
  padding-top:0.33rem;
  
}
.user-avator {
  margin-left: 0.5em;
}

.user-avator img {
  display: block;
  width: 50px;
  height: 50px;
  border-radius: 50%;
}
</style>
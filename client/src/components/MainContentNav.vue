<template>
  <!-- <div class="container"> -->
  <el-container>
    <el-header id="head-nav">
      <el-menu
        :default-active="activeIndex"
        class="el-menu-demo"
        mode="horizontal"
        @select="handleSelect"
        router
      >
        <el-menu-item @click="goPage(1)" class="nav-item">首页</el-menu-item>
        <el-menu-item @click="goPage(2)" class="nav-item"
          >歌单广场</el-menu-item
        >
        <el-menu-item @click="goPage(3)" class="nav-item"
          >热门歌手</el-menu-item
        >
        <el-menu-item @click="goPage(4)" class="nav-item"
          >我的音乐</el-menu-item
        >
      </el-menu>
    </el-header>
    <!-- 中间展示部分 -->
    <el-main>
      <router-view />
    </el-main>
    <!-- 底部播放控件 -->
    <!-- <el-footer> -->
    <!-- </el-footer> -->
  </el-container>

  <!-- </div> -->
</template>


<script>
export default {
  components: {},
  data() {
    return {
      activeIndex: "1", //elmentui里的:default-active="activeIndex"表示当前激活菜单的index
    };
  },
  methods: {
    handleSelect(key, keyPath) {
      console.log(key, keyPath);
    },
    goPage(num) {
      // if(num===1){
      //   this.$router.push({path: '/home'})
      // }
      switch (num) {
        case 1:
          this.$router.push({ path: "/home" });
          break;
        case 2:
          this.$router.push({ path: "/song" });
          break;
        case 3:
          this.$router.push({ path: "/singer" });
          break;
        case 4:
          this.$router.push({ path: "/mymusic" });
          break;
      }
    },
  },
};
</script>

<style scoped>
/* 公共样式 */
@import url("../assets/css/common.css");
.el-container {
  width: 100%;
}
#head-nav {
  margin: 0;
  padding: 0;
  height: 50px !important; /**覆盖默认高度 */
}
.el-menu-demo {
  background-color: #a59aca;
  
  height: 100%;
}
.nav-item {
  height: 100%;
  color:rgb(54, 26, 26);
}
/* 标签悬停 */
.nav-item:hover {
}
/* 中间内容版块 */
.el-main {
  padding: 0;
  margin:0;
  border: 0;
  height: 547px;
  background-color: #e9e7ef;
}
/* 滚动侧边栏隐藏 */
.el-main::-webkit-scrollbar {
  /* display: none; */
  width: 4px;
}
/* 滚动条样式 */
.el-main::-webkit-scrollbar-thumb {
  background-color: rgb(91, 172, 131);
  border-radius: 5px;
}
/* 底部播放组件
.el-footer {
  background-color: rgb(144, 189, 174);
} */

.audio {
  width: 60%;
  margin-left: 30px;
}
/* -----------三个测试字体------------ */
.testfont {
  background: #ffffff;
  font-size: 3em;
  font-family: "Bogart-Semibold";
}
.testfont1 {
  background: #ffffff;
  font-size: 3em;
  font-family: "Montserrat";
}
.testfont2 {
  background: #ffffff;
  font-size: 3em;
  font-family: "SimHei";
}
/* -------------测试字体 ------------*/
</style>
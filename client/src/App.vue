<template>
  <div id="app">
    <router-view />
  </div>
</template>

<script>
export default {
  name: "App",
};
</script>

<style>
/* #app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
} */
body {
  width:100%;
  height:100%;
  /* height:200px; */
  font-family: "微软雅黑"; /*  设置字体 */
  margin: 0px; /* 去除上下的边距 */
  /* background-image: url(./assets/img/背景.jpg) ; fffde4*/
  background:linear-gradient(#654ea3, #eaafc8);   
  background-repeat: no-repeat;
  background-size:cover;
}
.el-popover{
  height: 400px;
  overflow: auto;
  margin-bottom: 1rem;
  /* margin-left: -12rem; */
}
/* 滚动侧边栏隐藏 */
.el-popover::-webkit-scrollbar {
  /* display: none; */
  width: 3px;
}
/* 滚动条样式 */
.el-popover::-webkit-scrollbar-thumb {
  background-color: rgb(178, 144, 182);
  border-radius:3px;
}

</style>

<template>
  <div id="container">
    <song-audio></song-audio>
    <!-- 测试的播放组件 -->
    <!-- <vue-audio></vue-audio> -->
    <client-header></client-header>
    <main-content-nav></main-content-nav>
    <!-- <content-nav></content-nav> -->
    <play-bar></play-bar>
    
  </div>
</template>


<script>
import ClientHeader from "./ClientHeader.vue"; //头部
import MainContentNav from "./MainContentNav.vue"; //中间内容
import ContentNav from "./ContentNav.vue";
import PlayBar from "./PlayBar.vue";
import SongAudio from "./SongAudio.vue";
import VueAudio from "./VueAudio.vue";
export default {
  components: {
    ClientHeader,
    MainContentNav,
    ContentNav,
    PlayBar,
    SongAudio,
    VueAudio,
  },
};
</script>


<style scoped>
#container {
  /* 主体 */
  width: 68%;
  min-height:721px;
  /* min-height: 700px; */
  position: relative;
  margin: auto;
}
</style>

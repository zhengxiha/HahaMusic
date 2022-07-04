<template>
  <div id="music_bar">
    <audio id="music" ref="audio" controls >
      <!-- <source src="../assets/return.flac" /> -->
      <source :src="url"/>
    </audio>
    <br />
    <el-button type="primary" size="default" @click="changeMusic"
      >切换音乐</el-button
    >
  </div>
</template>

<script>
export default {
  data() {
    return {
     url: require("../assets/陈势安-天后.mp3"),//什么原理啊，refs绑定了还要加require才能播放
    };
  },
  methods: {
    changeMusic() {
      // url = "../assets/return.flac";
      this.$refs.audio.src = this.url;//
      //  this.$refs.audio.play()
    },
  },
};
</script>

<template>
  <div class="recommand-area">
    <!-- <div class="recomand-positiion">
      <h3>推荐歌单</h3> -->
      <ul class="display-list">
        <li
          class="display-item"
          v-for="(item, index) in contentList"
          :key="item.songlistId"
        >
          <img :src="item.url||item.singerImg" alt="" @click="goSongList(item)" />
          <div class="song-name">{{ item.title||item.singerName }}</div>
        </li>
      </ul>
    </div>
  
</template>

<script>
export default {
  data() {
    return {};
  },
  props: {
    contentList: {
      type: Array,
      default: function () {
        return [];
      },
    },
    path:String
  },
  methods: {
    // 跳转歌单内容
    goSongList(item) {
      // this.$store.commit('setTempList', item.songlistId)
      this.$store.commit('setTempList', item)
      this.$router.push({ path: `/${this.path}/${item.songlistId||item.singerId}`});
      console.log('歌单id:',item.songlistId,item);
    },
  },
};
</script>

<style scoped>
@import url("../assets/css/common.css");
/*--------------------------------------推荐歌单 */
.recommand-area {
  min-height: 440px;
  width: 90%;
  /* background-color: rgb(231, 230, 222); */
  margin: auto;
  padding: 10px;
}
.recomand-positiion {
  margin-left: 25px;
}

h3 {
  padding: 0;
  margin: 10px 20px 0px;
  font-size: 1.4em;
  font-family: "楷体";
}
</style>
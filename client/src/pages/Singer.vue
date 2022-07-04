<template>
    <div class="songarea">
    <!-- 推荐歌单 -->
    <div class="allsong-area">
      <div class="allsong-positiion">
          <div class="songhead-area">
              <h3>全部歌手</h3>
              <div class="head-right">
              </div>
          </div>
          <content-list :contentList="songList" path="singerinfo"></content-list>
        <!-- <ul class="display-list">
          <li class="display-item" v-for="(item, index) in 11" :key="index">
            <img
              src="../assets/img/test_img.jpg"
              alt="item.title" @click="goSongList"
            />
            <div class="song-name">歌单标题</div>
          </li>
        </ul> -->
      </div>
    </div>
  </div>
    </div>

</template>
<script>
import { HttpManager } from "../api/index";
import ContentList from '../components/ContentList.vue'
export default {
    components: {
    ContentList,
  },
   data() {
    return {
      songList: [], // 歌单列表
    };
  },
   created () {
    // 获取歌手列表
    this.getSingerList()
  },
  methods:{
    //  goSongList(){
    //   this.$router.push({path: `/songlist`})
    // },
    // 获取后台歌单图片
     getSingerList () {
      HttpManager.getSingerList()
        .then(res => {
          // this.songList = res.data[index].url
          console.log(res)
          this.songList=res.data
        })
        .catch(err => {
          console.log(err)
        })
    },
  }
};
</script>
<style scoped>
@import url("../assets/css/common.css");
.allsong-area {
  min-height: 440px;
  width: 90%;
  /* background-color: rgb(231, 230, 222); */
  margin: auto;
  padding: 10px;
}
.allsong-positiion {
  margin-left: 25px;
  height: 58px;
}
h3 {
    float:left;
  display: inline;
}
/* 头部分类列表 */
.songhead-area {
  height: 50px;
}
.head-right {
  position: relative;
  float: right;
  padding-right: 10px;
}
.classification-list {
  display: inline-block;
  margin: 0;
  padding: 0;
}
.classification-list li {
  float: left;
  margin: 10px;
  list-style-type: none;
}
h3 {
  padding: 0;
  margin: 10px 20px 0px;
  font-size: 1.4em;
  font-family: "楷体";
}
</style>

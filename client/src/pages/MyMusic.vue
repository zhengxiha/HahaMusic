<template>
  <div class="content-box">
    <div class="mymusic">
      <el-tabs class="mymusic-table" tab-position="left" style="height: 200px">
        <el-tab-pane label="歌单收藏">
          <div id='nocontent' v-show="showActive">这还是一片空地呢！快去添加歌单吧</div>
          <content-list :contentList="songList" path="songlist"></content-list>
          <!-- 歌单收藏 -->
          <!-- <ul class="display-list">
            <li class="display-item" v-for="(item, index) in 4" :key="index">
              <img
                src="../assets/img/test_img.jpg"
                alt="item.title"
                @click="goSongList"
              />
              <div class="song-name">歌单标题</div>
            </li>
          </ul> -->
          <!-- <ul class="display-list">
                <li
                  class="display-item"
                  v-for="(item, index) in songList"
                  :key="item.songlistId"
                >
                  <img :src="item.url" />
                  <div class="song-name">{{ item.title }}</div>
                </li>
              </ul> -->
        </el-tab-pane>
        <el-tab-pane label="歌曲收藏">
          <el-table class="songlist-table" :data="mysong" style="width: 100%">
            <el-table-column type="index"> </el-table-column>
            <el-table-column label="歌名" width="180">
              <template slot-scope="scope">
                <span>{{ scope.row.songName }}</span>
              </template>
            </el-table-column>
            <el-table-column label="歌手" width="150">
              <template slot-scope="scope">
                <span>{{ scope.row.singer }}</span>
              </template>
            </el-table-column>
            <el-table-column label="播放" width="210">
              <template slot-scope="scope">
                <i
                  class="play-icon"
                  @click="handleClick(scope.$index, scope.row)"
                >
                  <svg class="icon" aria-hidden="true">
                    <use :xlink:href="BOFANG"></use>
                  </svg>
                </i>
                <!-- <i class="like-icon">
                  <svg class="icon" aria-hidden="true">
                    <use :xlink:href="XIHUAN"></use>
                  </svg>
                </i> -->
                <!-- <i class="addlist-icon">
                  <svg class="icon" aria-hidden="true">
                    <use :xlink:href="TIANJIA"></use>
                  </svg>
                </i>
                <i class="like-icon">
                  <svg class="icon" aria-hidden="true">
                    <use :xlink:href="XIAZAI"></use>
                  </svg>
                </i> -->
              </template>
            </el-table-column>
            <el-table-column label="时长" width="100">
              <template slot-scope="scope">
                <span>{{scope.row.time}}</span>
              </template>
            </el-table-column>
          </el-table>
          <!-- <songlist-table :tableDate="mysong"></songlist-table> -->
        </el-tab-pane>
      </el-tabs>
    </div>
  </div>
</template>
<script>
import { ICON } from "../assets/icon/index";
import { HttpManager } from "../api/index";
import { mapGetters } from "vuex";
import ContentList from "../components/ContentList.vue";
import SonglistTable from "../components/SonglistTable.vue";
export default {
  components: {
    ContentList,
    SonglistTable,
  },
  computed: {
    ...mapGetters([
      "userId", // 用户ID
    ]),
  },
  data() {
    return {
      BOFANG: ICON.BOFANG, //播放
      XIAZAI: ICON.XIAZAI, //下载
      XIHUAN: ICON.XIHUAN, //喜欢
      TIANJIA: ICON.TIANJIA, //添加到听歌列表
      songList: [], // 歌单列表
      mysong: [],
      showActive:true
    };
  },
  created() {
    // 获取用户歌单列表
    this.getmySongList();
    // 获取用户歌曲列表
    this.getmySong();
  },
  methods: {
    //  goSongList(){
    //   this.$router.push({path: `/songlist`})
    // },
    // 获取后台歌单图片
    getmySongList() {
      HttpManager.getmySongList(this.userId)
        .then((res) => {
          // this.songList = res.data[index].url
          if(res.data.length!=0){
            // document.querySelector('#nocontent').innerHTML="您还没有收藏过歌单呢"
            this.showActive=false
          }
          console.log("我的歌单res:", res);
          this.songList = res.data;
          
        })
        .catch((err) => {
          console.log(err);
        });
    },
    getmySong() {
      HttpManager.getmySong(this.userId)
        .then((res) => {
          // this.songList = res.data[index].url
          console.log("我的歌曲res:", res);
          this.mysong = res.data;
          console.log("我的歌曲 ：", this.mysong);
        })
        .catch((err) => {
          console.log(err);
        });
    },
    handleClick(index, row) {
      this.$store.commit("setId", row.songId);
      this.$store.commit("setUrl", row.songUrl);
      this.$store.commit("setTitle", row.songName);
      this.$store.commit("setArtist", row.singer);
      this.$store.commit("setListIndex", index);
      this.$store.commit("setpicUrl", row.songImg);
      this.$store.commit("setLyric", row.lyric);
      console.log("点击的歌曲url", row.songUrl);
      console.log("点击的歌曲名", row.songName);
      console.log("点击的歌曲index", index);
      console.log("点击的歌曲图片", row.songImg);
    },
  },
};
</script>
<style scope>
@import url("../assets/css/common.css");
.content-box {
  height: 530px; /*内容盒子----先设固定*/
  margin-top: 0;
  /* margin: auto; */
  /* background-color: rgb(218, 146, 118); */
}
.mymusic {
  min-height: 440px;
  width: 90%;
  /* background-color: rgb(231, 230, 222); */
  margin: auto;
  /* padding-top: 5rem; */
  padding: 10px;
}
.mymusic-table {
  min-height: 440px;
  margin-top: 2rem;
}
#nocontent{
  font-size: 25px;
  font-family: "仿宋";
  color: rgb(126, 178, 212);
  width:80%;
  margin:11rem 13rem;
}
</style>

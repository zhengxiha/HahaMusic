<template>
  <div class="songlist-container">
    <!-- 歌单介绍 -->
    <div class="songlist-info">
      <div class="songlist-img">
          <img :src="tempList.singerImg" /></div>
      <div class="songlist-describe">
        <h3>{{ tempList.singerName }}</h3>
        <h6>生日：{{tempList.birth}}</h6>
        <div class="songlist-content">
         歌手简介：{{tempList.introduce}}
        </div>
        <el-button>播放全部</el-button>
        <el-tag type="success">{{tempList.location}}</el-tag>
      </div>
    </div>
    <songlist-table></songlist-table>
  </div>
</template>
<script>
import { ICON } from "../assets/icon/index";
import SonglistTable from "../components/SonglistTable.vue";
import { mapGetters } from "vuex";
import { HttpManager } from "../api/index";
export default {
    components:{
        SonglistTable
    },
    data() {
    return {
      SHOUCAN: ICON.SHOUCAN,
      songLists: [],
    //   songListId: "", // 歌单ID
    //   singers: {},
    };
  },
  computed: {
    ...mapGetters([     
      "tempList", // 单个歌单信息
    //   "listOfSongs", // 存放的音乐
    ]),
  },
  created() {
    this.singerId = this.tempList.singerId; //当前歌单ID
    this.getSingersong();
  },
  methods: {
    // 获取当前歌单的ID
    getSingersong() {
      HttpManager.getSingersongs(this.singerId)
        .then((res) => {
          // 获取歌单里的歌曲信息
          this.songLists = res.data;
          this.$store.commit("setListSongs", res.data);
          console.log("输出res", res);
          console.log("输出歌手歌曲:", this.songLists);
        })
        .catch((err) => {
          console.log(err);
        });
    },
  }
};
</script>
<style scoped>
@import url("../assets/css/common.css");
.songlist-container {
  min-height: 440px;
  width: 90%;
  /* background-color: rgb(231, 230, 222); */
  margin: auto;
  padding: 10px;
}
/* 歌单介绍 */
.songlist-info {
  width: 100%;
}

.songlist-img {
  margin-left: 2rem;
  width: 30%;
  display: inline-block;
  /* background: rgb(190, 106, 106); */
  float: left;
}
.songlist-img img{
  width:75%;
  /* padding:2rem; */
}
.songlist-describe {
  position: relative;
  width: 55%;
  height: 200px;
  /* background: rgb(247, 243, 243); */
  display: inline-block;
  /* float: right; */
}
/* 歌单介绍 !*/
.icon {
  width: 30px;
}
.shoucan-icon {
  width: 40px;
  float: right;
  margin: 0 2rem 2rem;
}
/* 列表部分 */
.songlist-table {
}
</style>
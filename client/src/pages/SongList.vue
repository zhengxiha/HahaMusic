<template>
  <div class="songlist-container">
    <!-- 歌单介绍 -->
    <div class="songlist-info">
      <div class="songlist-img"><img :src="tempList.url" /></div>
      <div class="songlist-describe">
        <h3>{{ tempList.title }}</h3>
        <div class="songlist-content">
          {{ tempList.introduction }}
        </div>
        <el-button @click="playAll()">播放全部</el-button>
        <el-tag type="success">{{ tempList.tag }}</el-tag>
        <span><svg class="shoucan-icon" @click="starActive()" aria-hidden="true">
            <use :xlink:href="shoucanIcon"></use>
          </svg></span>
      </div>
    </div>
    <!-- 歌单列表 -->
    <!-- <songlist-table :tableData="listofSongs"></songlist-table> -->
    <songlist-table></songlist-table>
  </div>
</template>
<script>
import mixin from "../mixins";
import { ICON } from "../assets/icon/index";
import SonglistTable from "../components/SonglistTable.vue";
import { mapGetters } from "vuex";
import { HttpManager } from "../api/index";
export default {
  mixins: [mixin],
  components: {
    SonglistTable,
  },
  data() {
    return {
      // SHOUCAN: ICON.SHOUCAN,
      songLists: [],
      songListId: "", // 歌单ID
      singers: {},
      // 初始收藏图标
      shoucanIcon: ICON.SHOUCAN
    };
  },
  watch: {},
  computed: {
    ...mapGetters([
      "loginIn", // 登录标识
      "tempList", // 单个歌单信息
      "listOfSongs", // 存放的音乐
      "userId", // 用户ID
      "avator", // 用户头像
      "colSongList" //收藏的歌单
    ]),
  },
  created() {
    this.songListId = this.tempList.songlistId; //当前歌单ID
    this.getSongId();//获取当前歌单信息
  },
  methods: {

    // 获取当前歌单ID取相应数据
    getSongId() {
      HttpManager.getListSongOfSongId(this.songListId)
        .then((res) => {
          // 判断是否已收藏 
          this.colSongList.forEach(item => {
            if (item.songlistId === this.songListId) {
              this.shoucanIcon = ICON.SHOUCAN1
            }
          });
          // 获取歌单里的歌曲信息
          this.songLists = res.data;
          this.$store.commit("setListSongs", res.data);
          // this.$store.commit("setListOfSongs", res.data);
          console.log("输出res", res);
          console.log("输出this.songLists:", this.songLists);
        })
        .catch((err) => {
          console.log(err);
        });
    },
    // 播放全部，将歌单内的歌曲加入到播放列表listOfSongs
    playAll() {
      // 第一种 push.apply(arr1,arr2) arr1是将新增的数组，arr2是源数组
      // this.listOfSongs.push.apply(this.listOfSongs,this.songLists)
      //第二种 ...是es6的语法，解析的意思
      this.listOfSongs.push(...this.songLists)
      console.log("播放全部后的播放列表：", this.listOfSongs);
      this.$store.commit("setListOfSongs", this.listOfSongs);
    },

    // ------------收藏
    starActive() {
      // this.isActive?this.isActive=0:this.isActive=1 
      let param = this.starParams();
      HttpManager.collectionSonglist(param).then(res => {
        console.log(res.data)
        if (res.data === '收藏成功') {
          this.isActive = 1;
          this.shoucanIcon = ICON.SHOUCAN1
        } else {
          this.isActive = 0;
          this.shoucanIcon = ICON.SHOUCAN
        }

      })
    },
    // 注册参数注入
    starParams() {
      let param = {
        user_id: this.userId,
        songlist_id: this.songListId,
      };
      return param;
    },
  },
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

/* .songlist-img img{
  width:100%;
} */
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

/* 收藏图标状态 */
/* .starActive{
  filter:  drop-shadow(red 0px 0);
  transform: translateX(0px);
} */
/* 列表部分 */
.songlist-table {}
</style>
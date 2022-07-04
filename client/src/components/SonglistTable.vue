<template>
        <!-- 歌单列表 -->
    <div class="songlist-list">
      <!-- 头部 -->
      <div class="songlist-head">
        <h4>
          <!-- <span>歌曲列表</span> -->
          <span>共{{this.listSongs.length}}首歌</span>
        </h4>
      </div>
      <!-- 列表 -->
      <el-table class="songlist-table" :data="listSongs" style="width: 100%">
      <!-- <el-table class="songlist-table" :data="listOfSongs" style="width: 100%"> -->
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
          <i class="play-icon" @click="handleClick(scope.$index,scope.row)">
            <svg class="icon" aria-hidden="true">
              <use :xlink:href="BOFANG"></use>
            </svg>
          </i>
          <!-- 列表内收藏暂时不做 -->
          <!-- <i class="like-icon">
            <svg class="icon" aria-hidden="true">
              <use :xlink:href="xihuanIcon"></use>
            </svg>
          </i> -->
          <!-- <i class="addlist-icon">
            <svg class="icon" aria-hidden="true" @click="addSong(scope.row)">
              <use :xlink:href="TIANJIA"></use>
            </svg>
          </i> -->
          <!-- 下载也暂时不做了 -->
          <!-- <i class="xiazai-icon">
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
    </div>
 
</template>
<script>
import mixin from "../mixins";
import { ICON } from "../assets/icon/index";
import { mapGetters } from "vuex";
export default {
      mixins: [mixin],
  //      props: {
  //     tableData: {
  //       type: Array,
  //       default: function () {
  //         return [];
  //       },
  //     },
  //     path:String
  //   },
  computed: {
    ...mapGetters([
      "loginIn", // 登录标识
      "tempList", // 单个歌单信息
      "listSongs", // 存放的音乐
      "listOfSongs",//播放列表
      "userId", // 用户ID
      "avator", // 用户头像
      "url",
      "lyric",
      "picUrl",
      "colSong"//收藏歌曲
    ]),
  },
  data() {
    return {
      BOFANG: ICON.BOFANG, //播放
      XIAZAI: ICON.XIAZAI, //下载
      // XIHUAN: ICON.XIHUAN, //喜欢
      TIANJIA: ICON.TIANJIA, //添加到听歌列表
      // xihuanIcon:ICON.XIHUAN,
      tableData: [],
    };
  },
  methods: {
    handleClick(index,row) {
        this.$store.commit('setId', row.songId)
        this.$store.commit("setUrl", row.songUrl)
        this.$store.commit("setTitle", row.songName)
        this.$store.commit("setArtist", row.singer)
        this.$store.commit('setListIndex', index)
        this.$store.commit("setpicUrl", row.songImg)
        this.$store.commit('setLyric', row.lyric)
       
      },
  //       addSong(row){
  //   // this.listOfSongs.push(...listSongs);
  //   this.listOfSongs.push(row);
  //   this.$store.commit("setListOfSongs",this.listOfSongs);
  // }
  },

};
</script>
<style scoped>
@import url("../assets/css/common.css");
</style>
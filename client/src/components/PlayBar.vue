<template>
  <div class="play-bar">
    <div class="kongjian">
      <!--上一首-->
      <div class="item" @click="prev">
        <svg class="icon" aria-hidden="true">
          <use :xlink:href="SHANGYISHOU"></use>
        </svg>
      </div>
      <!--播放暂停-->
      <div class="item" @click="togglePlay">
        <svg class="icon" aria-hidden="true">
          <!-- <use :xlink:href="playButtonUrl"></use> -->
          <use :xlink:href="playButton"></use>
        </svg>
      </div>
      <!--下一首-->
      <div class="item" @click="next">
        <svg class="icon" aria-hidden="true">
          <use :xlink:href="XIAYISHOU"></use>
        </svg>
      </div>
      <!--歌曲图片-->
      <div class="item-img" @click="goSongDetail">
        <img :src="picUrl" alt="" />
      </div>
      <!--播放进度-->
      <div class="playing-speed">
        <!--播放开始时间-->
        <div class="current-time">{{ nowTime }}</div>
        <div class="progress-box">
          <div class="item-song-title">
            <!-- 下面两个插入歌名和歌手 -->
            <div>{{ this.title }}-</div>
            <div>{{ this.artist }}</div>
          </div>
          <div ref="progress" class="progress" @mousemove="mousemove">
            <!--进度条-->
            <div ref="bg" class="bg">
              <div ref="curProgress" class="cur-progress" :style="{ width: curLength + '%' }"></div>
            </div>
            <!--进度条 end -->
            <!--拖动的点点-->
            <div ref="idot" class="idot" :style="{ left: curLength + '%' }" @mousedown="mousedown" @mouseup="mouseup">
            </div>
            <!--拖动的点点 end -->
          </div>
        </div>
        <!--播放结束时间-->
        <div class="left-time">{{ songTime }}</div>
      </div>
      <!--音量-->
      <div class="item icon-volume">
        <svg v-if="volume !== 0" class="icon" aria-hidden="true">
          <use :xlink:href="YINLIANG"></use>
        </svg>
        <svg v-else class="icon" aria-hidden="true">
          <use :xlink:href="JINGYIN"></use>
        </svg>
        <el-slider class="volume" v-model="volume" :vertical="true"></el-slider>
      </div>
      <!--爱心-->
      <div class="item">
        <svg :class="{ active: isActive }" @click="likeActive()" class="icon" aria-hidden="true">
          <use :xlink:href="xihuanIcon"></use>
        </svg>
      </div>
      <!--下载-->
      <!-- <div class="item" @click="downloadMusic()">
        <svg :class="{ active: isActive }" class="icon" aria-hidden="true">
          <use :xlink:href="XIAZAI"></use>
        </svg>
      </div> -->
      <!--歌曲列表-->
      <div class="item">
        <!-- <svg class="icon" aria-hidden="true" @click="songlist()">
          <use :xlink:href="LIEBIAO"></use>
        </svg> -->
        <el-popover placement="right" width="240" trigger="click">
          <el-table :data="listOfSongs">
            <!-- 歌曲名 -->
            <el-table-column label="播放列表" width="185">
              <template slot-scope="scope">
                <span>{{ scope.row.songName }}</span>
                <span id="singer">{{ scope.row.singer }}</span>
              </template>
            </el-table-column>
            <!-- 删除 -->
            <el-table-column width="50">
              <template slot-scope="scope">
                <span>
                  <svg slot="reference" class="icon-shangchu" aria-hidden="true"
                    @click.prevent="deleteRow(scope.$index, listOfSongs)">
                    <use :xlink:href="SHANGCHU"></use>
                  </svg>
                </span>
              </template>
            </el-table-column>
          </el-table>
          <!-- 歌曲列表图标 -->
          <svg slot="reference" class="icon" aria-hidden="true" @click="songlist()">
            <use :xlink:href="LIEBIAO"></use>
          </svg>
          <!-- <el-button slot="reference">click 激活</el-button> -->
        </el-popover>
      </div>
    </div>
  </div>
</template>

<script>
import mixin from "../mixins";
import { ICON } from "../assets/icon/index";
import { mapGetters } from "vuex";
import { HttpManager } from "../api/index";
// import store from "../store/index";
export default {
  mixins: [mixin],
  data() {
    return {
      isActive: 0, //收藏状态
      playButton: ICON.BOFANG,
      tag: false,
      nowTime: "00:00",
      songTime: "00:00",
      curLength: 0, // 进度条的位置
      progressLength: 0, // 进度条长度
      mouseStartX: 0, // 拖拽开始位置
      toggle: true,
      volume: 50,
      BOFANG: ICON.BOFANG,
      ZANTING: ICON.ZANTING,
      XIAZAI: ICON.XIAZAI,
      SHANGYISHOU: ICON.SHANGYISHOU,
      XIAYISHOU: ICON.XIAYISHOU,
      YINLIANG: ICON.YINLIANG,
      JINGYIN: ICON.JINGYIN,
      LIEBIAO: ICON.LIEBIAO,
      SHANGCHU: ICON.SHANGCHU,
      xihuanIcon: ICON.XIHUAN,
    };
  },
  computed: {
    ...mapGetters([
      "loginIn", // 用户登录状态
      "userId", // 用户 id
      "isPlay", // 播放状态
      "playButtonUrl", // 播放状态的图标
      "id", // 音乐id
      "url", // 音乐地址
      "picUrl", // 歌曲图片
      "curTime", // 当前音乐的播放位置
      "duration", // 音乐时长
      "title",
      "artist",
      "listOfSongs", // 当前歌单列表
      "listIndex", // 当前歌曲在歌曲列表的位置
      "autoNext", // 用于触发自动播放下一首
      // "isActive", //还没做收藏
      "colSong", //收藏的歌曲
    ]),
  },
  watch: {
    // 切换播放状态的图标
    isPlay(val) {
      if (val) {
        this.playButton = ICON.ZANTING;
        // this.$store.commit("setPlayButtonUrl", ICON.ZANTING);
        // console.log("暂停图标")
      } else {
        this.playButton = ICON.BOFANG;
        // this.$store.commit("setPlayButtonUrl", ICON.BOFANG);
        // console.log("播放图标")
      }
    },
    volume() {
      this.$store.commit("setVolume", this.volume / 100);
    },
    // 播放时间的开始和结束
    curTime() {
      this.nowTime = this.formatSeconds(this.curTime);
      this.songTime = this.formatSeconds(this.duration);
      // 移动进度条
      this.curLength = (this.curTime / this.duration) * 100;
      // 处理歌词位置及颜色
    },
  },
  created() {
    // this.songId = this.id; //当前歌曲ID
    // this.getSongId();//获取当前歌单信息
    // this.likeActive();
  },
  methods: {
    // 上一首
    prev() {
      // console.log('点击了上一首')
      if (this.listIndex !== -1 && this.listOfSongs.length > 1) {
        if (this.listIndex > 0) {
          this.$store.commit("setListIndex", this.listIndex - 1);
          this.toPlay(this.listOfSongs[this.listIndex].songUrl);
        } else {
          this.$store.commit("setListIndex", this.listOfSongs.length - 1);
          this.toPlay(this.listOfSongs[this.listIndex].songUrl);
        }
        // console.log('listIndex=',this.listIndex)
      }
    },
    // 下一首
    next() {
      if (this.listIndex !== -1 && this.listOfSongs.length > 1) {
        if (this.listIndex < this.listOfSongs.length - 1) {
          this.$store.commit("setListIndex", this.listIndex + 1);
          this.toPlay(this.listOfSongs[this.listIndex].songUrl);
        } else {
          this.$store.commit("setListIndex", 0);
          this.toPlay(this.listOfSongs[0].songUrl);
        }
      }
      // console.log('点击了下一首,当前歌单有',this.listOfSongs.length,'首歌')
    },
    // 选中播放
    toPlay(url) {
      if (url && url !== this.url) {
        this.$store.commit("setId", this.listOfSongs[this.listIndex].songId);
        this.$store.commit(
          "setTitle",
          this.listOfSongs[this.listIndex].songName
        );
        this.$store.commit(
          "setArtist",
          this.listOfSongs[this.listIndex].singer
        );
        this.$store.commit(
          "setpicUrl",
          this.listOfSongs[this.listIndex].songImg
        );
        this.$store.commit("setLyric", this.listOfSongs[this.listIndex].lyric);
        this.$store.commit("setUrl", this.listOfSongs[this.listIndex].songUrl);
        // this.songid=this.listOfSongs[this.listIndex].songId
        // this.$store.commit("setLyric",this.parseLyric(this.listOfSongs[this.listIndex].  lyric));
        // 判断是否收藏过
        this.xihuanIcon = ICON.XIHUAN;
        this.colSong.forEach((item) => {
          if (item.songId === this.id) {
            this.xihuanIcon = ICON.XIHUAN1;
            console.log("此歌曲已收藏");
          }
        });
      }
    },
    // ---------------------------------收藏
    likeActive() {
      // this.isActive?this.isActive=0:this.isActive=1
      let param = this.likeParams();
      HttpManager.collectionSong(param).then((res) => {
        console.log(res.data);
        if (res.data === "收藏成功") {
          // this.isActive=1;
          this.xihuanIcon = ICON.XIHUAN1;
        } else {
          // this.isActive=0;
          this.xihuanIcon = ICON.XIHUAN;
        }
      });
    },
    // 收藏参数注入
    likeParams() {
      let param = {
        user_id: this.userId,
        song_id: this.id,
      };
      return param;
    },
    // =======================================
    // 切换播放状态
    togglePlay() {
      if (this.isPlay) {
        this.$store.commit("setIsPlay", false);
        // this.$store.commit("setPlayButtonUrl", ICON.ZANTING);
        console.log("暂停");
      } else {
        this.$store.commit("setIsPlay", true);
        // this.$store.commit("setPlayButtonUrl", ICON.BOFANG);
        console.log("播放");
      }
    },
    // 解析播放时间
    formatSeconds(value) {
      let theTime = parseInt(value);
      let theTime1 = 0;
      let theTime2 = 0;
      if (theTime > 60) {
        theTime1 = parseInt(theTime / 60); // 分
        theTime = parseInt(theTime % 60); // 秒
        // 是否超过一个小时
        if (theTime1 > 60) {
          theTime2 = parseInt(theTime1 / 60); // 小时
          theTime1 = 60; // 分
        }
      }
      // 多少秒
      if (parseInt(theTime) < 10) {
        var result = "0:0" + parseInt(theTime);
      } else {
        result = "0:" + parseInt(theTime);
      }
      // 多少分钟时
      if (theTime1 > 0) {
        if (parseInt(theTime) < 10) {
          result = "0" + parseInt(theTime);
        } else {
          result = parseInt(theTime);
        }
        result = parseInt(theTime1) + ":" + result;
      }
      // 多少小时时
      if (theTime2 > 0) {
        if (parseInt(theTime) < 10) {
          result = "0" + parseInt(theTime);
        } else {
          result = parseInt(theTime);
        }
        result = parseInt(theTime2) + ":" + parseInt(theTime1) + ":" + result;
      }
      return result;
    },
    // 拖拽开始
    mousedown(e) {
      this.mouseStartX = e.clientX;
      this.tag = true;
    },
    // 拖拽结束
    mouseup() {
      this.tag = false;
    },
    // 拖拽中
    mousemove(e) {
      if (!this.duration) {
        return false;
      }
      if (this.tag) {
        let movementX = e.clientX - this.mouseStartX;
        let curLength = this.$refs.curProgress.getBoundingClientRect().width;
        //  计算出百分比
        this.progressLength = this.$refs.progress.getBoundingClientRect().width;
        let newPercent = ((curLength + movementX) / this.progressLength) * 100;
        if (newPercent > 100) {
          newPercent = 100;
        }
        this.curLength = newPercent;
        this.mouseStartX = e.clientX;
        //  根据百分比推出对应的播放时间
        this.changeTime(newPercent);
      }
    },
    // 更改歌曲进度
    changeTime(percent) {
      let newCurTime = this.duration * (percent * 0.01);
      this.$store.commit("setChangeTime", newCurTime);
    },
    updatemove(e) {
      if (!this.tag) {
        let curLength = this.$refs.bg.offsetLeft;
        this.progressLength = this.$refs.progress.getBoundingClientRect().width;
        let newPercent = ((e.clientX - curLength) / this.progressLength) * 100;
        if (newPercent < 0) {
          newPercent = 0;
        } else if (newPercent > 100) {
          newPercent = 100;
        }
        this.curLength = newPercent;
        this.changeTime(newPercent);
      }
    },
    goSongDetail() {
      this.$router.push({ path: `/songdetail` });
    },
    // 下载
    // downloadMusic () {
    //   HttpManager.downloadMusic(this.url)
    //     .then(res => {
    //       let content = res.data
    //       let eleLink = document.createElement('a')
    //       eleLink.download = `${this.artist}-${this.title}.mp3`
    //       eleLink.style.display = 'none'
    //       // 字符内容转变成blob地址
    //       let blob = new Blob([content])
    //       eleLink.href = URL.createObjectURL(blob)
    //       // 触发点击
    //       document.body.appendChild(eleLink)
    //       eleLink.click()
    //       // 然后移除
    //       document.body.removeChild(eleLink)
    //     })
    //     .catch(err => {
    //       console.log(err)
    //     })
    // },

    // 删除歌曲
    deleteRow(index, rows) {
      rows.splice(index, 1);
      this.$store.commit("setListOfSongs", this.listOfSongs);
      console.log("点击了删除按钮");
      // this.listOfSongs.remove({
      //       content:this.comment,
      //       date:this.commentTime,
      //       userName:this.username
      //     })
    },
  },
  mounted() {
    this.progressLength = this.$refs.progress.getBoundingClientRect().width;
    document.querySelector(".icon-volume").addEventListener(
      "click",
      function (e) {
        document.querySelector(".volume").classList.add("show-volume");
        e.stopPropagation();
      },
      false
    );
    document.querySelector(".volume").addEventListener(
      "click",
      function (e) {
        e.stopPropagation();
      },
      false
    );
    document.addEventListener(
      "click",
      function () {
        document.querySelector(".volume").classList.remove("show-volume");
      },
      false
    );
  },
};
</script>

<style scoped>
@import url("../assets/css/common.css");

.play-bar {
  bottom: 0;
  width: 100%;
  transition: all 0.5s;
  background-color: #fcfcfc77;
  height: 60px;
}

/* 控件盒子 */
.kongjian {
  bottom: 0;
  height: 60px;
  width: 80%;
  margin: auto;
  /* min-width: 1000px; */
  padding-top: 0.35rem;
}

/* 小控件区 */
.item {
  position: relative;
  width: 60px;
  height: 60px;
  text-align: center;
  float: left;
}

.icon.active {
  color: red !important;
}

/* 图标 */
.item {
  width: 3em;
}

.icon {
  font-size: 2rem;
  position: relative;
}

.item-img {
  width: 50px;
  height: 50px;
  display: inline-block;
  float: left;
}

.item-img img {
  width: 100%;
  border-radius: 2rem;
}

/* 播放进度盒 */
.playing-speed {
  display: inline-block;
  float: left;
}

.current-time {
  float: left;
  font-size: 1.3rem;
}

.left-time {
  float: right;
  font-size: 1.3rem;
}

/* 歌曲名-歌手 */
.item-song-title div {
  display: inline-block;
}

/* 进度条 */
.progress-box {
  width: 270px;
  height: 50px;
  float: left;
}

.progress {
  width: 100%;
  background: #e7c4c4;
  height: 6px;
}

.bg {
  height: 100%;
}

.cur-progress {
  height: 100%;
  background: #db7d10;
}

.idot {
  width: 16px;
  height: 16px;
  position: relative;
  border-radius: 50%;
  background-color: black;
  top: -11px;
  vertical-align: middle;
}

/* 播放进度盒！ */
/* 音量 */
.volume {
  position: relative;
  display: none;
  height: 100px;
  top: -9rem;
  right: -1rem;
}

.show-volume {
  display: block;
}

/* 音量！ */
#singer {
  font-size: 0.01em;
  color: #b9b0a4;
}

/* 删除图标 */
.icon-shangchu {
  width: 1.22em;
  height: 1.22em;
  vertical-align: -0.15em;
  fill: currentColor;
  overflow: hidden;
  float: right;
}
</style>
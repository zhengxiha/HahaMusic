<template>
  <div class="detail-container">
    <div class="song-detail">
      <!-- 歌词部分 -->
      <div class="song-lyric">
        <!-- CD转盘 -->
        <div class="CD-display">
          <cd-show class="cd-show"></cd-show>
        </div>
        <!-- 歌词显示 -->
        <div class="lyric">
          <transition-group name="lyric-fade">
            <ul
              :style="{ top: lrcTop }"
              class="has-lyric"
              v-if="lyr.length"
              key="has-lyric"
            >
              <li v-for="(item, index) in lyr" v-bind:key="index">
                {{ item[1] }}
              </li>
            </ul>
            <div v-else class="no-lyric" key="no-lyric">
              <span>暂无歌词</span>
            </div>
          </transition-group>
          <!-- -------------------------------------------------- -->
        
        </div>
      </div>
      <!-- <comment :playId="id" :type="0"></comment> -->
      <!-- 评论 -->
      <div class="song-comment">
        <comment></comment>
      </div>
    </div>
  </div>
</template>
<script>
import mixin from "../mixins";
import CdShow from "../components/CdShow.vue";
import Comment from "../components/Comment.vue";
import { mapGetters } from "vuex";
export default {
  mixins: [mixin],
  components: {
    CdShow,
    Comment,
  },
  data() {
    return {
      lrcTop: "200px", // 歌词滑动
      showLrc: false, // 切换唱片和歌词
      lyr: [], // 当前歌曲的歌词
      // ------------scroll------
      currentLine:-1,//当前歌词高亮的行
      nextTime:0
    };
  },
  computed: {
    ...mapGetters([
      "curTime",
      "id", // 歌曲ID
      "lyric", // 歌词
      "listOfSongs", // 存放的音乐
      "listIndex", // 当前歌曲在歌曲列表的位置
    ]),
  },
  watch: {
    id: function () {
      // 监听歌曲歌词
      this.lyr = this.parseLyric(this.lyric);
    },
    // 播放时间的开始和结束
    curTime: function () {
      // 处理歌词位置及颜色
      if (this.lyr.length !== 0) {
        for (let i = 0; i < this.lyr.length; i++) {
          if (this.curTime >= this.lyr[i][0]) {
            for (let j = 0; j < this.lyr.length; j++) {
              // document.querySelectorAll(".has-lyric")[j].style.marginTop="";
              document.querySelectorAll(".has-lyric li")[j].style.color =
                "#745399";
              document.querySelectorAll(".has-lyric li")[j].style.fontSize =
                "15px";
            }
            if (i >= 0) {
              document.querySelectorAll(".has-lyric li")[i].style.color =
                "#69b076";
              document.querySelectorAll(".has-lyric li")[i].style.fontSize =
                "17px";
            }    
          }
        }
      }
      
    },
    
  },
    created() {
      this.lyr = this.parseLyric(this.lyric);
      console.log('这里是created的歌词',lyr);
      // this.lyr = this.lyric ? this.lyric : [];
  },
  methods: {
  },

  mounted(){
      
  },
  
};
</script>
<style scoped>
.detail-container {
  /* width: 100%;
  height: 530px; 内容盒子----先设固定 */
  /* position: relative;
  margin: auto; */

  margin-top: 0;
  /* background-color: rgb(97, 160, 94); */
}
.song-detail {
  width: 90%;
  margin: auto;
  /* background: rgb(161, 113, 113); */
}
/* 歌词部分 */

.song-lyric {
  width: 100%;
  height: 27rem;
  /* background: red; */
}
/* CD展示 */
.CD-display {
  margin-top: 4rem;
  width: 49%;
  height: 100%;
  display: inline-block;
  /* background: rgb(16, 206, 190); */
}
.cd-show {
  /* width:80%; */
}
/* 歌词 */
.lyric {
  margin-top: 2rem;
  float: right;
  display: inline-block;
  height: 90%;
  width: 50%;
  /* background: rgb(16, 206, 190); */
  /* 超出区域部分隐藏 */
  overflow:hidden;
  overflow-y: scroll;
  /* position:relative; */
}

.lyric::-webkit-scrollbar {
        display: none;
    }
.lyricWrapper{
  width:85%;
  margin:auto;
  /* background: red; */
}

.lyric-area{
  margin:auto
}
.has-lyric {
  /* position:relative; */
  font-size: 18px;
  padding: 30px 0;
  width: 100%;
  min-height: 170px;
  text-align: center;
}
li {
  width: 100%;
  height: 40px;
  line-height: 40px;
   list-style-type:none; 
}

/* 歌词部分！ */
/* 评论 */
.song-comment {
  width: 100%;
  /* background: rgb(60, 173, 164); */
}
</style>
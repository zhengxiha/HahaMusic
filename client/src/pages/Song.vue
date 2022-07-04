<template>
  <div class="songarea">
    <!-- 推荐歌单 -->
    <div class="allsong-area">
      <div class="allsong-positiion">
        <div class="songhead-area">
          <!-- <h3>全部歌单</h3> -->
          <div class="head-right">
            <ul class="classification-list">
              <!-- <li>华语</li>
                  <li>欧美</li>
                  <li>日韩</li>
                  <li>粤语</li> -->
              <li v-for="(item, index) in listStyle" :key="index" :class="{ active: item.type === activeType }"
                @click="handleChangeView(item.type)">{{ item.name }}</li>
            </ul>
          </div>
        </div>
        <content-list :contentList="songList" path="songlist"></content-list>
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


</template>
<script>
import { HttpManager } from "../api/index";
import ContentList from "../components/ContentList.vue";
export default {
  components: {
    ContentList,
  },
  data() {
    return {
      isType: '',//点击状态
      songList: [], // 歌单列表
      albumDatas: [], // 歌单
      // title:'',

      // 分类名
      listStyle: [
        {
          name: '全部歌单',
          type: 0
        },
        {
          name: '华语',
          type: 1
        },
        {
          name: '粤语',
          type: 2
        },
        {
          name: '日韩',
          type: 3
        },
        {
          name: '欧美',
          type: 4
        },
      ]
    };
  },
  mounted() {
    this.handleChangeView(0)
  },
  created() {
    // 获取歌单列表
    this.getSongList()
  },
  methods: {
    goSongList() {
      this.$router.push({ path: `/songlist` });
    },
    // 获取歌单
    handleChangeView: function (type) {
      console.log("type的id:", type)
      this.activeType = type
      console.log("type的id:", this.activeType)
      this.songList = []
      if (type === 0) {
        this.getSongList()
      } else {
        // this.activeName=type
        this.getSongListOfStyle(type)
      }
    },
    // 获取全部歌单图片
    getSongList() {
      HttpManager.getSongList()
        .then(res => {
          // this.songList = res.data[index].url
          console.log(res)
          this.songList = res.data
        })
        .catch(err => {
          console.log(err)
        })
    },
    getSongListOfStyle(type) {
      HttpManager.getTypelists(type).then(res => {
        console.log("分类的歌单：", res)
        this.songList = res.data
      })
        .catch(err => {
          console.log(err)
        })
    }
  },
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
  float: left;
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

/* 点击的分类样式 */
.classification-list .active {
  color: rgb(7, 5, 5);
  /* font-size: 20px; */
  font-weight: 600;
  font-family: "";
}
</style>

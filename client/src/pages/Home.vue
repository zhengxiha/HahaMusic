<template>
  <div class="singerarea">
    <!-- 跑马灯  -->
    <div class="carousel-area">
      <el-carousel :interval="4000" type="card" height="200px">
        <el-carousel-item v-for="item in imgList" :key="item.id">
          <img :src="item.idView" class="image" />
        </el-carousel-item>
      </el-carousel>
    </div>
    <!-- 推荐歌单 -->
     <div class="recomand-positiion">
      <h3>推荐歌单</h3>
    <content-list :contentList="songList" path="songlist"></content-list>
    </div>
  </div>
</template>

<script>
import { HttpManager } from "../api/index";
import ContentList from '../components/ContentList.vue'
export default {
  components:{
    ContentList
  },
  data() {
    return {
      // 走马灯图片
      imgList: [
        { id: 0, idView: require("../assets/img/banner1.jpg") },
        { id: 1, idView: require("../assets/img/banner2.jpg") },
        { id: 2, idView: require("../assets/img/banner3.png") },
        { id: 3, idView: require("../assets/img/banner4.png") },
      ],
      //
      currentDate: new Date(),
      songList: [], // 歌单列表
      // title:'',
    };
  },
  created () {
    // 获取歌单列表
    this.getSongListtop()
  },
  methods: {
     getSongListtop() {
      HttpManager.getSongListtop()
        .then(res => {
          this.songList=res.data
        })
        .catch(err => {
          console.log(err)
        })
    },
  },
};
</script>
<style scoped>
@import url("../assets/css/common.css");


/* 外部盒子 */
.singerarea {
  /* height: 530px; */
  margin-top: 0;
  background-color: #f8f4e6;
}
/*----------------------- 走马灯 */
.carousel-area {
  background: #ffffff;
  text-align: center;
}
.carousel-area img {
  width: 100%;
  display: block;
}
.el-carousel__item:nth-child(2n) {
  background-color: #99a9bf;
}

.el-carousel__item:nth-child(2n + 1) {
  background-color: #d3dce6;
}
/* -------------------------------------走马灯!*/
/*--------------------------------------推荐歌单 */
.recommand-area {
  min-height: 440px;
  width: 90%;
  /* background-color: rgb(231, 230, 222); */
  margin: auto;
  padding: 10px;
}
.recomand-positiion {
  margin-left: 60px;
}

h3 {
  padding: 0;
  margin: 10px 30px 0px;
  font-size: 1.4em;
  font-family: "楷体";
}

/* --------------------------------推荐歌单! */
</style>



<template>
  <div>
    <div class="comment">
      <h2>
        评论
        <span class="part__tit_desc">共{{commentList.length}}评论</span>
      </h2>
      <div class="comment-msg">
        <el-input
          class="comment-input"
          type="textarea"
          placeholder="期待您的精彩评论..."
          :rows="2"
          v-model="comment"
        >
        </el-input>
      </div>
      <el-button plain type="primary" size="small" class="sub-btn" @click="commentTosong()"
        >发表评论</el-button
      >
    </div>
    <div class="a-line"></div>
    <ul class="popular" v-for="(item, index) in commentList" :key="index">
      <li>
        <div class="popular-img">
          <!-- 这个暂时先统一头像 -->
          <img src="../assets/img/test_img.jpg" alt="" />
        </div>
        <div class="popular-msg">
          <div class="name">{{item.userName}}</div>
          <div class="content">
            {{item.content}}
          </div>
        </div>
        <div class="up" ref="up">
          <!-- 点赞先不要了 -->
          <!-- <svg class="icon" aria-hidden="true">
            <use :xlink:href="ZAN"></use>
          </svg> -->
          <div class="time">{{item.date}}</div>
        </div>
      </li>
    </ul>
  </div>
</template>
<script>
import { HttpManager } from "../api/index";
import { mapGetters } from "vuex";
import { ICON } from "../assets/icon/index";
export default {
  data() {
    return {
      ZAN: ICON.ZAN,
      comment:'',//评论
      commentList:[],//所有评论
      commentTime:'' //评论的时间
    };
  },
  computed: {
    ...mapGetters([
      "id", // 歌曲ID
      "userId",
      "username"
    ]),
  },
  created () {
    // 获取歌单列表
    this.getCommentList()
  },
  methods:{
    // 提交评论
    commentTosong(){
      let _this = this;
      let param=this.commentParam()
      HttpManager.commentTosong(param).then(res=>{
        console.log("提交的评论：",res)
        if (res.code === 200) {
          _this.$message({
            message: "评论成功",
            type: "success",
          });
          
        // ---------------------
        // 将评论数据unshift进评论数组中
          this.getCommentDate()
        // unshift()将元素放到数组的第一个，push()则是将元素放到最后
          this.commentList.unshift({
            content:this.comment,
            date:this.commentTime,
            userName:this.username
          })

        // ------------
        this.comment=''
        } else {
          this.$message({
            message: "评论失败",
            type: "success",
          });
        }
      })
     
    },
     // 注册参数注入
    commentParam() {
      let param = {
        user_id: this.userId,
        song_id: this.id,
        content: this.comment,
      };
      return param;
    },
    // 获取评论的当前时间
    getCommentDate(){
      const myDate=new Date()
      const date={
              year:myDate.getFullYear(),
              month:myDate.getMonth() + 1,
              date:myDate.getDate(),
              h:myDate.getHours(),
              m:myDate.getMinutes()
              }
               const newmonth = date.month>10?date.month:'0'+date.month
               const day = date.date>10?date.date:'0'+date.date
               const h = date.h>9?date.h:'0'+date.h
               const m = date.m>9?date.m:'0'+date.m
               this.commentTime = date.year + '-' + newmonth + '-' + day+' '+h+':'+m
    },
    // 获取所有评论
    getCommentList(){
      HttpManager.getSongcomment(this.id).then(res=>{
        this.commentList=res.data;
      })
    }
  }

};
</script>
<style scoped>
.comment {
  position: relative;
}
h2 {
  margin-bottom: 10px;
  font-family: "楷体";
  margin-left: 3rem;
}
.part__tit_desc {
  font-size: 15px;
  /* margin-left: 10px; */
}
.comment-msg {
  width: 90%;
  margin: 0 3rem;
}

/* 评论按钮 */
.sub-btn {
  float: right;
  margin-right: 2.8rem;
}
.a-line {
  width: 100%;
  height: 1px;
  background: #35343441;
  overflow: hidden;
  margin-top: 2.7rem;
}
/* hr{
  margin-top: 2.3rem;

} */
/* 评论区 */
.popular {
  width: 100%;
  /* margin: 2rem 0.6rem 0; */
}
/* 单条评论 */
.popular li {
  border-bottom: solid 1px rgba(0, 0, 0, 0.1);
  padding: 10px 0;
  display: flex;
  width: 85%;
  /* height: 80px; */
}
.popular-img {
  width: 50px;
}
.popular-img img {
  width: 100%;
}

.popular-msg {
  padding: 0 1rem;
  flex: 1;
}
.name {
  display: inline-block;
  width: 100%;
  height: 1.5rem;
  color: rgba(0, 0, 0, 0.5);
}
.time {
  width:100px;
  display: inline-block;
  font-size: 0.6rem;
  color: black;
  float: right;
  padding: 0;
  /* margin:0; */
  /* margin-right:2rem; */
}

.content {
  display: inline-block;
  font-size: 1rem;
  width: 90%;
}

.up {
  width: 20px;
  /* line-height: 77px; */
  font-size: 18px;
}
.icon {
  width: 1.5rem;
  height: 1.5rem;
  font-size: 1reme;
  color: red;
  fill: currentColor;
  overflow: hidden;
  position: relative;
}
</style>
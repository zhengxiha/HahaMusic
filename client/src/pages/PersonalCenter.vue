<template>
  <div class="personal-area">
    <div class="main-area">
      <el-tabs class="mymusic-table" tab-position="left">
        <!-- 基本信息 -->
        <el-tab-pane label="基本信息">
          <div class="basic-info">
            <div class="person-img">
              <img :src="this.avator" />
              <el-upload
                class="upload-demo"
                action=""
                :show-file-list="false"
                :http-request="httpRequest"
                :before-upload="beforeUpload"
                accept="image/jpeg,image/jpg,image/png"
              >
                <!-- @click="submitFile()" -->
                <el-button size="small" type="primary">更改头像</el-button>
              </el-upload>
            </div>
            <div class="info-area">
              <!-- 用户信息展示 -->
              <ul>
                <li><span>账&#8195&#8195号：</span>{{ userInfo.userId }}</li>
                <li>
                  <span>用&#8194户&#8194名：</span
                  >{{ userInfo.userName ? userInfo.userName : "无" }}
                </li>
                <li><span>性&#8195&#8195别：</span>{{ userInfo.sex | sexTypeFilter }}</li>
                <li>
                  <span>生&#8195&#8195日：</span
                  >{{ userInfo.birth ? userInfo.birth : "无" }}
                </li>
                <li>
                  <span>手&#8194机&#8194号：</span
                  >{{ userInfo.phone ? userInfo.phone : "无" }}
                </li>
                <li>
                  <span>邮&#8195&#8195箱：</span
                  >{{ userInfo.email ? userInfo.email : "无" }}
                </li>
                <li>
                  <span>个性签名：</span
                  >{{ userInfo.sign ? userInfo.sign : "无" }}
                </li>
                <li><span>注册时间：</span>{{ userInfo.registrationTime }}</li>
              </ul>
              <!-- 表单修改弹窗 -->
              <el-button type="text" @click="dialogFormVisible = true"
                >编辑信息</el-button
              >
              <el-dialog
                title="基本信息编辑"
                width="26%"
                center
                :visible.sync="dialogFormVisible"
              >
                <el-form :model="form" label-width="80px">
                  <el-form-item label="用户名">
                    <el-input
                      placeholder="用户名"
                      v-model="form.username"
                    ></el-input>
                  </el-form-item>
                  <el-form-item label="性别">
                    <el-radio-group v-model="form.sex">
                      <el-radio :label="0">男</el-radio>
                      <el-radio :label="1">女</el-radio>
                    </el-radio-group>
                  </el-form-item>
                  <el-form-item label="生日">
                    <el-date-picker
                      type="date"
                      placeholder="选择日期"
                      v-model="form.birth"
                      style="width: 100%"
                    ></el-date-picker>
                  </el-form-item>
                  <el-form-item label="手机号">
                    <el-input
                      placeholder="手机"
                      v-model="form.phone"
                    ></el-input>
                  </el-form-item>
                  <el-form-item label="邮箱">
                    <el-input
                      placeholder="邮箱"
                      v-model="form.email"
                    ></el-input>
                  </el-form-item>
                  <el-form-item label="个性签名">
                    <el-input placeholder="签名" v-model="form.sign"></el-input>
                  </el-form-item>
                </el-form>
                <div slot="footer" class="dialog-footer">
                  <el-button @click="dialogFormVisible = false"
                    >取 消</el-button
                  >
                  <el-button type="primary" @click="submitEdit()"
                    >确 定</el-button
                  >
                  <!-- <el-button type="primary" @click="dialogFormVisible = false"
                    >确 定</el-button
                  > -->
                </div>
              </el-dialog>
            </div>
          </div>
        </el-tab-pane>
        <!-- 修改密码 -->
        <el-tab-pane label="修改密码">
          <el-form
            :model="ruleForm"
            status-icon
            :rules="rules"
            ref="ruleForm"
            label-width="100px"
            class="demo-ruleForm"
          >
            <el-form-item label="旧密码" prop="opass">
              <el-input
                type="password"
                v-model="ruleForm.opass"
                autocomplete="off"
              ></el-input>
            </el-form-item>
            <el-form-item label="密码" prop="pass">
              <el-input
                type="password"
                v-model="ruleForm.pass"
                autocomplete="off"
              ></el-input>
            </el-form-item>
            <el-form-item label="确认密码" prop="checkPass">
              <el-input
                type="password"
                v-model="ruleForm.checkPass"
                autocomplete="off"
              ></el-input>
            </el-form-item>
            <el-form-item>
              <el-button type="primary" @click="submitPassword()"
                >提交</el-button
              >
              <el-button @click="resetForm('ruleForm')">重置</el-button>
            </el-form-item>
          </el-form>
        </el-tab-pane>
      </el-tabs>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import { HttpManager } from "../api/index";

// 过滤器不能调用this,所以数据写在data外
const sexType = [
  { type: 0, name: "男" },
  { type: 1, name: "女" },
];
export default {
  data() {
    // ----------------修改密码
    var validatePass = (rule, value, callback) => {
      if (value === "") {
        callback(new Error("请输入密码"));
      } else {
        if (this.ruleForm.checkPass !== "") {
          this.$refs.ruleForm.validateField("checkPass");
        }
        callback();
      }
    };
    var validatePass2 = (rule, value, callback) => {
      if (value === "") {
        callback(new Error("请再次输入密码"));
      } else if (value !== this.ruleForm.pass) {
        callback(new Error("两次输入密码不一致!"));
      } else {
        callback();
      }
    };
    // --------------修改密码！------------
    return {
      userInfo: {},
      sexType: "",
      fileList: [],
      // -----------弹窗
      dialogFormVisible: false,
      form: {
        username: "",
        sex: "",
        phone: "",
        email: "",
        sign: "",
        birth: "",
      },
      //---------- 修改密码
      ruleForm: {
        pass: "",
        opass:"",//旧密码
        checkPass: "",
      },
      rules: {
        pass: [{ validator: validatePass, trigger: "blur" }],
        checkPass: [{ validator: validatePass2, trigger: "blur" }],
      },
    };
  },
  // 过滤器
  filters: {
    sexTypeFilter(type) {
      const sexTy = sexType.find((obj) => obj.type === type);
      return sexTy ? sexTy.name : null;
    },
  },
  computed: {
    ...mapGetters([
      "avator", // 单个歌单信息
      "userId",
      //   "listOfSongs", // 存放的音乐
    ]),
  },
  created() {
    // this.id=this.$userId
    // this.submitFile()
    this.getUserInfo();
  },
  methods: {
    // 覆盖默认的上传行为，将上传的文件添加到fileList数组中
    httpRequest(option) {
      this.fileList.push(option);
      console.log("上传后");
      const paramsData = new FormData();
      paramsData.append("userId", this.userId);
      // paramsData.append('image',this.file)
      this.fileList.forEach((x) => {
        paramsData.append("image", x.file);
      });
      HttpManager.uploadAvator(paramsData).then((res) => {
        if (res.code === 200) {
          // this.avator=this.$store.state.configure.HOST+this.fileName
          // this.avator=res.data.avator
          this.$store.commit("setAvator", res.data.avator);
          console.log("res.data:", res.data.avator);
          this.$message({
            message: "上传成功",
            type: "success",
          });
        } else {
          this.$message({
            message: "导入失败",
            type: "error",
          });
        }
      });
    },
    handlePreview(file) {
      console.log("文件信息", file);
    },
    upFile() {},
    // 文件上传前处理
    beforeUpload(file) {
      let fileSize = file.size;
      const FIVE_M = 5 * 1024 * 1024;
      //大于5M，不允许上传
      if (fileSize > FIVE_M) {
        this.$message.error("最大上传5M");
        return false;
      }
      //判断文件类型，必须是xlsx格式
      let fileName = file.name;
      let reg = /^.+(\.jpg|png|jpeg)$/;
      // let reg=/^image\/(jpeg|png|jpg)$/
      if (!reg.test(fileName)) {
        this.$message.error("只能上传jpg/png!");
        return false;
      }
      return true;
    },
    // 提交用户信息
    submitEdit() {
      let param = this.InfoParam();
      HttpManager.updateUser(param).then((res) => {
        this.userInfo.userName = res.data.userName;
        // this.username=res.data.userName;
        this.$store.commit("setUsername", res.data.userName);
        this.userInfo.sex = res.data.sex;
        this.userInfo.birth = res.data.birth;
        this.userInfo.phone = res.data.phone;
        this.userInfo.email = res.data.email;
        this.userInfo.sign = res.data.sign;
        console.log("更新后的数据：", res.data);
      });
      this.dialogFormVisible = false;
    },
    // 数据注入
    InfoParam() {
      let param = {
        userId: this.userId,
        userName: this.form.username,
        sex: this.form.sex,
        birth: this.form.birth,
        phone: this.form.phone,
        email: this.form.email,
        sign: this.form.sign,
      };
      return param;
    },
    // 提交头像文件
    // submitFile(){
    //   let _this = this;
    //   // let param=this.submitParam();
    //   const paramsData = new FormData();
    //   paramsData.append('userId',this.userId)
    //   this.fileList.forEach((x)=>{
    //     paramsData.append('image',x.file)
    //   })
    //   HttpManager.uploadAvator(paramsData).then((res)=>{
    //     if(res.code === 200){
    //       _this.$message({
    //         message:"上传成功",
    //         type:"success"
    //       })
    //     }else{
    //       _this.$message({
    //         message:"导入失败",
    //         type:"error"
    //       })
    //     }
    //   }

    //   )
    // },

    getUserInfo() {
      HttpManager.getUserinfo(this.userId)
        .then((res) => {
          this.userInfo = res.data;
          console.log("用户信息：", this.userInfo);
        })
        .catch((err) => {
          console.log(err);
        });
    },
    // ==============修改密码=============
    submitForm(formName) {
      this.$refs[formName].validate((valid) => {
        if (valid) {
          alert("submit!");
        } else {
          console.log("error submit!!");
          return false;
        }
      });
    },
    resetForm(formName) {
      this.$refs[formName].resetFields();
    },
    submitPassword(){   
      if(this.ruleForm.checkPass===this.ruleForm.pass){
        let param=this.passwordParams();
        HttpManager.changePassword(param).then((res)=>{
          console.log(this.ruleForm.pass)
          console.log(res)
        // this.$message({
        //     message: "密码修改成功",
        //     type: "success",
        //   });

        if(res.code===200){
           this.$message({
            message: "密码修改成功！",
            type: "success",
          });
        }else{
            this.$message({
            message: "原密码错误，请重新输入",
            type: "error",
          });
        }
      })
      }else{
        this.$message({
            message: "两次输入密码不一致！",
            type: "error",
          });
      }
 
    },
    passwordParams(){
      let param={
        userId:this.userId,
        password:this.ruleForm.opass,
        npassword:this.ruleForm.pass,
      }
      return param
    }
  },
};
</script>
<style scoped>
@import url("../assets/css/common.css");
/* 外部盒子 */
.personal-area {
  margin-top: 0;
  min-height: 530px;
  width: 100%;
  /* background-color: rgb(97, 160, 94); */
}
.main-area {
  min-height: 440px;
  width: 90%;
  /* background-color: rgb(231, 230, 222); */
  margin: auto;
  /* padding-top: 5rem; */
  padding: 10px;
}
/* 分栏整体表 */
.mymusic-table {
  min-height: 440px;
  margin-top: 2rem;
  /* background: black; */
}
/* 分栏内容盒 */
.basic-info {
  /* background: rgb(248, 247, 247); */
  width: 90%;
  height: 400px;
  position: relative;
}
/* 头像 */
.person-img {
  width: 90px;
  /* height: 90px; */
  margin: auto;
}
.person-img img {
  width: 100%;
  border-radius: 4rem;
}

/* 信息部分 */
.info-area {
  width: 80%;
  margin:auto;
}
.info-area ul {
  /* padding-top: 2rem; */
  width: 50%;
  margin:auto;
  padding:2rem 0
}
.info-area li {
  list-style-type: none;
  padding-top: 0.35rem;
}
.info-area span {
  display: inline-block;
  /* width:80px; */
  text-align: justify;
}
.info-area .el-button{
  float: right;
  margin-right: 4rem;
}
/* 修改信息弹窗 */
.el-dialog {
}


/* 修改密码 */
.demo-ruleForm{
  width:50%;
  margin:auto;
  /* padding:1rem 0 */
}

.dialog-footer{
  padding-bottom: 2.1rem;
  margin-top: -2.5rem;
}

.demo-ruleForm .el-button{
  margin-left:3rem;
}
.demo-ruleForm label{
  /* margin:auto; */
  /* padding:0; */
}
</style>
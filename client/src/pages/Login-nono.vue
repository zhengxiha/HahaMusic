<template>
  <!-- 原有的登陆---------------------------------- -->
  <!-- <div>
    <form>
      <label for="account">账号:</label>
      <input type="text" v-model="account" id="account" ref="Raccount" />
      <br />
      <label for="pwd">密码:</label>
      <input type="text" v-model="pwd" id="pwd" ref="Rpwd" />
      <br />
      <label for="username">用户名：</label>
      <input type="text" v-model="username" id="username" ref="Rusername" />
      <br />
      <label for="email">邮箱:</label>
      <input type="text" v-model="email" id="email" ref="Remail" />
      <br />
      <button @click.prevent="login">登录</button>
    </form>
  </div> -->
  <!---------- 原有的登陆---------------------------------- -->

  <!-- 
    <div class="login-wrap">
        <el-form class="login-container">
            <h1 class="title">用户登录</h1>
            <el-form-item label="账号"> 
                <el-input type="text" v-model="account" placeholder="请输入账号" autocomplete="off"></el-input>
            </el-form-item>
            <el-form-item label="密码">
                <el-input type="password" v-model="password" autocomplete="off"></el-input>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" style="width: 100%;" @click="doSubmit()">提交</el-button>
            </el-form-item>
            <el-row style="text-align: center; margin-top: -10px;;">
                <el-link type="primary">忘记密码</el-link>
                <el-link type="primary" @click="doRegister()">用户注册</el-link>
            </el-row>
        </el-form>
    </div> -->

  <div class="container">
   
    <el-form
      :model="ruleForm"
      status-icon
      :rules="rules"
      ref="ruleForm"
      label-width="80px"
      class="login-container"
    >
    <h1 class="title">用户登录</h1>
      <el-form-item label="账号" prop="account">
        <el-input v-model.number="ruleForm.account"  autocomplete="off"placeholder="请输入账号"></el-input>
      </el-form-item>
      <el-form-item  label="密码" prop="pass" >
        <el-input
          type="password"
          v-model="ruleForm.pass"
          autocomplete="off"
          placeholder="请输入密码"
        ></el-input>
      </el-form-item>
      <el-form-item  label="确认密码" prop="checkPass" >
        <el-input
          type="password"
          v-model="ruleForm.checkPass"
          autocomplete="off"
          placeholder="请再次输入密码"
        ></el-input>
      </el-form-item>
     
      <el-form-item>
        <el-button type="primary" @click="submitForm('ruleForm')"
          >登陆</el-button
        >
        <el-button @click="resetForm('ruleForm')">重置</el-button>
      </el-form-item>
    </el-form>
  </div>
</template>

<script>
import { HttpManager } from "../api/index";
//
// export default {
//   name: "Login",
//   data() {
//     return {
//       account: "",
//       pwd: "",
//       username: "",
//       email: "",
//     };
//   },
//   methods: {
//     login() {
  
//       let param = this.registerParam();
//       HttpManager.loginIn(param).then((res) => {
//         console.log(res);
//       });
//     },
//     registerParam() {
//       let param = {
//         //这里的参数和api给的参数命名要一致
//         //方式一：用model里的数据直接获取
//         loginId: this.account,
//         password: this.pwd,
//         userName: this.username,
//         email: this.email,

//         //方式二：也可以用$refs的方式，里面的Raccount、Rpwd等在html里用ref命名
//         // loginId:this.$refs.Raccount.value,
//         // password:this.$refs.Rpwd.value,
//         // userName:this.$refs.Rusername.value,
//         // email:this.$refs.Remail.value,
//       };
//       return param;
//     },
//   },
// };
export default {
  data() {
     var checkAccount = (rule, value, callback) => {
      if (!value) {
        return callback(new Error("账号不能为空"));
      }
      callback();
    };
    var checkAge = (rule, value, callback) => {
      if (!value) {
        return callback(new Error("年龄不能为空"));
      }
      setTimeout(() => {
        if (!Number.isInteger(value)) {
          callback(new Error("请输入数字值"));
        } else {
          if (value < 18) {
            callback(new Error("必须年满18岁"));
          } else {
            callback();
          }
        }
      }, 1000);
    };
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
    
    return {
      ruleForm: {
        account:"",
        pass: "",
        checkPass: "",
        age: "",

      },
      rules: {
        account: [{ validator: checkAccount, trigger: "blur" }],
        pass: [{ validator: validatePass, trigger: "blur" }],
        checkPass: [{ validator: validatePass2, trigger: "blur" }],
        age: [{ validator: checkAge, trigger: "blur" }],
      },
    };
  },
  methods: {
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
  },
};
</script>

<style scoped>
.container{
  background-color: rgba(236, 218, 218, 0.281);
  border-radius: 15px;
  height: 450px;
  width: 350px;
  position: relative;
  overflow: hidden;
  margin: auto;
  margin-top: 5rem;
}
.container::after{
  content: "";
  opacity: 0.8;
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  background-repeat: no-repeat;
  background-position: left bottom;
  background-size: 500px;
  background-image: url("https://images.unsplash.com/photo-1503602642458-232111445657?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=bf884ad570b50659c5fa2dc2cfb20ecf&auto=format&fit=crop&w=1000&q=100");
}
.login-container{ 
 position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
  width: 65%;
  z-index: 5;
  -webkit-transition: all 0.3s ease;
}

.title{
  text-align: center;
  opacity: 1;
  visibility: visible;
  -webkit-transition: all 0.3s ease;
}
.el-input{
border: 0;
  outline: none;
  box-shadow: none;
  display: block;
  height: 30px;
  line-height: 30px;
  padding: 8px 15px;
  border-bottom: 1px solid #eee;
  width: 100%;
  font-size: 12px;
}

</style>


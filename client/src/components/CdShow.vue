<template>
  <div class="recordBox">
    <div class="recordBlack">
      <div class="recordIn">
        <div class="lines"></div>
        <div class="cd">cd</div>
        <div class="cricle"></div>
      </div>
      <div class="sun"></div>
    </div>
    <div class="fixed">
      <div class="arm"></div>
    </div>
  </div>
</template>
<script>
export default {

};
</script>
<style scoped>
.recordBox {
  width: 300px;
  height: 280px;
  /* background: #9cd8bd; */
  background:#ffffff;
  border-radius: 32%;
  /* margin: auto; */
  margin-left:3rem;
  position: relative;
}
.recordBlack {
  width: 200px;
  height: 200px;
  background: black;
  border-radius: 50%;
  position: absolute;
  left: 25px;
  top: 50%;
  margin-top: -100px;
}

.recordIn {
  width: 100%;
  height: 100%;
  position: absolute;
  animation: circle 1s linear infinite;
}

.recordBlack .lines {
  width: 180px;
  height: 180px;
  background: repeating-radial-gradient(black, black 5px, #1c1c1c 7px);
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
  border-radius: 50%;
}

.cd {
  font-family: "宋体";
  font-size: 12px;
  text-align: center;
  padding-top: 8px;
  box-sizing: border-box;
  width: 55px;
  height: 55px;
  border-radius: 50%;
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
  background: -webkit-linear-gradient(top, white 50%, pink 50%);
}

.cricle {
  position: absolute;
  left: 50%;
  top: 50%;
  background: black;
  width: 10px;
  height: 10px;
  border-radius: 50%;
  transform: translate(-50%, -50%);
}

.sun {
  width: 100%;
  height: 100%;
  background: -webkit-linear-gradient(
    45deg,
    transParent 35%,
    rgba(255, 255, 255, 0.2) 45%,
    rgba(255, 255, 255, 0.3) 50%,
    rgba(255, 255, 255, 0.2) 55%,
    transparent
  );
  border-radius: 50%;
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
}

.fixed {
  width: 40px;
  height: 40px;
  background: #939393;
  border-radius: 50%;
  border: 5px solid gray;
  position: absolute;
  right: 20px;
  top: 40px;
}

.arm {
  width: 60px;
  height: 110px;
  border: 10px solid #939393;
  position: absolute;
  right: 13px;
  top: 10px;
  border-left-color: transparent;
  border-top-color: transparent;
  transform: skew(-20deg, -20deg);
  transform-origin: right top;
  border-radius: 0 0 30% 0;
  animation: run 0.5s linear infinite alternate;
  /* //animation对应@keyframes;alternate交替运动 */
}

.arm:after {
  content: "";
  width: 20px;
  height: 30px;
  background: gray;
  position: absolute;
  top: 97px;
  left: -21px;
  transform: skew(20deg, 20deg) rotate(75deg);
}

@keyframes circle {
  100% {
    transform: rotate(360deg);
  }
}

@keyframes run {
  100% {
    transform: skew(-20deg, -20deg) rotate(2deg);
  }
}
</style>
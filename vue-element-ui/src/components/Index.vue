<template>
  <el-carousel :interval="4000" type="card" height="520px">
    <el-carousel-item v-for="item in carouselImg" :key="item">
      <el-image :src="item" style="width: 1280px height:520px">

      </el-image>
    </el-carousel-item>
  </el-carousel>
</template>

<style>
 .el-carousel__item h3 {
    color: #475669;
    font-size: 14px;
    opacity: 0.75;
    line-height: 200px;
    margin: 0;
  }

  .el-carousel__item:nth-child(2n) {
    background-color: #99a9bf;
  }

  .el-carousel__item:nth-child(2n+1) {
    background-color: #d3dce6;
  }
</style>

<script>
import carouselImg1 from '../assets/carousel_img/1.jpg'
import carouselImg2 from '../assets/carousel_img/2.jpg'
import carouselImg3 from '../assets/carousel_img/3.jpg'
import carouselImg4 from '../assets/carousel_img/4.jpg'

export default {
    setup(){
        const carouselImg = [carouselImg1, carouselImg2, carouselImg3, carouselImg4]
    
        return {carouselImg}
    }
}
</script>
<template>
    <el-container>
        <!-- 导航栏 -->
        <el-header>
            <el-menu
            :default-active="activeIndex"
            class="el-menu-demo"
            mode="horizontal"
            @select="handleSelect"
            background-color="#545c64"
            text-color="#fff"
            active-text-color="#ffd04b">
            <el-menu-item index="/index">主页</el-menu-item>
            <el-menu-item index="/users">用户管理</el-menu-item>
            <el-menu-item index="/msgs">消息中心</el-menu-item>
            <el-menu-item index="/orders">订单管理</el-menu-item>
            </el-menu>
        </el-header>

        <el-main>
          <router-view/>
        </el-main>
  </el-container>
</template>

<script>
import { useRouter, useRoute } from "vue-router";

export default({
  setup(){
      const router = useRouter();
      const route = useRoute();

      const activeIndex = '/index';
      const handleSelect = (key, keyPath) => {
          router.push(key)
      }
      return {
          activeIndex,
          handleSelect,
      };
  },
});
</script>
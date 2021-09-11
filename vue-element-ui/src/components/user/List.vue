<template>
  <el-table :height="340"
    :data="tableData.filter(data => !search || data.name.toLowerCase().includes(search.toLowerCase()))"
    style="width: 100%">

    <el-table-column
      label="编号"
      width="280">
      <template #default="scope">
        <span style="margin-left: 10px">{{ scope.row.id }}</span>
      </template>
    </el-table-column>

    <el-table-column
      label="姓名"
      width="280">
      <template #default="scope">
        <el-popover effect="light" trigger="hover" placement="top">
          <template #default>
            <p>姓名: {{ scope.row.name }}</p>
            <p>住址: {{ scope.row.address }}</p>
          </template>
          <template #reference>
            <div class="name-wrapper">
              <el-tag size="medium">{{ scope.row.name }}</el-tag>
            </div>
          </template>
        </el-popover>
      </template>
    </el-table-column>

    <el-table-column label="出生日期" prop="date" width="280"></el-table-column>
    <el-table-column label="性别" prop="sex" width="280"></el-table-column>
    <el-table-column label="地址" prop="address" width="490"></el-table-column>


    <el-table-column align="right" width="230">
      <template #header>
        <el-input
          v-model="search"
          size="mini"
          placeholder="输入姓名以搜索"/>
      </template>
      <template #default="scope">
        <el-button
          size="mini"
          @click="handleEdit(scope.$index, scope.row)">编辑</el-button>

        <el-popconfirm title="确定要删除当前用户吗？" @confirm="handleDelete(scope.$index, scope.row)">
            <template #reference>
                <el-button size="mini" type="danger">删除</el-button>
            </template>
        </el-popconfirm>

      </template>
    </el-table-column>

  </el-table>
  <!-- 分页 -->
  <el-pagination @current-change="handlePageChange" background 
                 ayout="prev, pager, next, jumper" :total="total" 
                 style="text-align:center" :page-size="5"> 
                 </el-pagination>
  <!-- 添加按钮 -->
  <el-button type="success" size="mini" style="margin: 10px" @click="addUserInfo">添加</el-button>

  <transition name="el-zoom-in-center">
        <div v-show="show" class="transition-box">

            <el-form ref="userform" :model="form" :rules="rules" label-width="100px" label-suffix=":">
            <el-form-item label="姓名" prop="name">
                <el-input v-model="form.name" placeholder="请输入姓名"></el-input>
            </el-form-item>
            
            <el-form-item label="出生日期" prop="date">
                <el-date-picker type="date" format="YYYY-MM-DD" value-format="YYYY-MM-DD" placeholder="选择日期" v-model="form.date" style="width: 100%;"></el-date-picker>
            </el-form-item>

            <el-form-item label="性别" prop="sex">
                <el-radio-group v-model="form.sex">
                    <el-radio label="男"></el-radio>
                    <el-radio label="女"></el-radio>
                </el-radio-group>
            </el-form-item>

            <el-form-item label="地址" prop="address">
                <el-input type="textarea" v-model="form.address" placeholder="请输入地址"></el-input>
            </el-form-item>

            <el-form-item>
                <el-button type="primary" @click="onSubmit('userform')">保存</el-button>
                <el-button @click="resetUserInfo">重置</el-button>
            </el-form-item>
            </el-form>
        </div>
  </transition>

</template>

<script>
  import axios from 'axios'
  import { ElMessage } from 'element-plus'
import _Empty from 'element-plus/lib/components/empty'

    export default {
        data() {
            return {
                tableData: [],
                search:'',
                show: false,
                total: 0,
                form: {
                    name: '',
                    address: '',
                    date: '',
                    currentPage: 1,
                    sex: '男',
                },
                rules: {
                    name: [
                        { required: true, message: '请输入姓名', trigger: 'blur' },
                    ],
                    date: [
                        { required: true, message: '请输入日期', trigger: 'blur' },
                    ],
                    address: [
                        { required: true, message: '请输入地址', trigger: 'blur' },
                    ]
                },
            }
        },
        methods: {
            addUserInfo(){
                this.show = !this.show
                this.form={sex:'男'}   
            },
            resetUserInfo(){
                this.form={sex:'男'}
            },

            handleEdit(index, row){
                this.show = ! this.show
                this.form = row
            },
            handlePageChange(page){
                this.currentPage = page-1
                axios.get(process.env.VUE_APP_BASEURL+'index/getuser'+'?page='+(page-1)).then(res=>{
                    this.tableData = res.data
                }) 
            },
            getUser(){
                axios.get(process.env.VUE_APP_BASEURL+'index/getuser').then(res=>{
                    this.tableData = res.data
                })
            },
            getUserByPage(page){
                axios.get(process.env.VUE_APP_BASEURL+'index/getuser?page='+page).then(res=>{
                    this.tableData = res.data
                })
            },
            getTotal(){
                axios.get(process.env.VUE_APP_BASEURL+'index/gettotal').then(res=>{
                    this.total = res.data
                })
            },


            // 删除数据
            handleDelete(index, row) {
            axios.get(process.env.VUE_APP_BASEURL+'index/deluser'+'?id='+row.id).then(res=>{
                if(res.data.status){
                    ElMessage.success({
                        message: '恭喜你，'+res.data.message,
                        type: 'success',
                    })
                    //刷新
                    this.getUserByPage(this.currentPage)
                    this.getTotal()
                }else{
                    ElMessage.error(res.data.message)
                }
            }) 
            },
            // 添加和更改
            onSubmit(userform){
                // 表单验证
                this.$refs[userform].validate((valid) => {
                    if (valid) {
                        // 验证成功发送axios
                        axios({
                            url: process.env.VUE_APP_BASEURL+"index/saveuser",
                            method: "post",
                            data: this.form,
                            transformRequest: [function (data) {
                                // Do whatever you want to transform the data
                                let ret = ''
                                for (let it in data) {
                                // 如果要发送中文 编码 
                                ret += encodeURIComponent(it) + '=' + encodeURIComponent(data[it]) + '&'
                                }
                                return ret
                            }],
                            headers: {'Content-Type':'application/x-www-form-urlencoded' }
                        })
                        .then(res=>{
                            if(res.data.status){
                                ElMessage.success({
                                    message: '恭喜你，' + res.data.message,
                                    type: 'success',
                                })
                                this.form = {sex:'男'}
                                this.show = false
                                this.getUserByPage(this.currentPage)
                                this.getTotal()
                            }else{
                                ElMessage.error(res.data.message)
                                return false
                            }
                        }) 
                    }else{
                        ElMessage.error('对不起，未经允许的数据格式')
                    }
                })
            },
        },
        created(){
            this.getUser()
            this.getTotal() 
        },
    }
</script>


<style>
 .transition-box {
    margin-bottom: 10px;
    width: 1800px;
    height: 600px;
    border-radius: 4px;
    background-color: #fff;
    text-align: left;
    color: #fff;
    padding: 40px 20px;
    box-sizing: border-box;
    margin-right: 20px;
  }
</style>

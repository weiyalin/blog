<template>
    <div class="header" :style="{background : 'url('+head_bg+') no-repeat center -79px'}">
        <el-menu mode="horizontal" style="background-color: rgba(246,234,212,0.7);">
            <el-submenu index="user">
                <template slot="title">{{username}}</template>
                <el-menu-item index="user/resetPassword">修改密码</el-menu-item>
            </el-submenu>
            <el-menu-item index='logout'>
                退出系统
            </el-menu-item>
        </el-menu>
    </div>
</template>

<script>
    export default{
        data() {
            return {
                username : "weiyalin",
                head_bg  : "http://localhost:83/dist/img/head_bg.jpg",
            }
        },
        methods: {

        }
    }
</script>

<template>
    <div class="my_header">
        <div class="title">
            {{ app_name }}
        </div>
        <el-menu default-active="1" class="el-menu-cls header_menu" :router=false mode="horizontal" @select='handleSelect'>
            <el-submenu index="user" class="username">
                <template slot="title">{{ username }}</template>
                <el-menu-item index="/user/password">修改密码</el-menu-item>
            </el-submenu>
            <el-menu-item index='logout'>
                退出系统
            </el-menu-item>
        </el-menu>
        <div style="clear:both;"></div>
    </div>
</template>
<style>
    .username > .el-submenu__title> .el-icon-caret-bottom{
        color: white !important;
    }
    .header_menu > .is-active{
        color: rgb(0, 115, 57) !important;
    }
    .my_header > ul {
        background-color: transparent !important;
    }

    .my_header > ul > li, .my_header .el-submenu__title {
        color: white;
    }

    .my_header > ul > li:hover, .my_header .el-submenu__title:hover {
        background-color: transparent !important;
    }

    .my_header {
        background-color: rgb(0, 168, 84);
    }

    .my_header .title {
        float: left;
        margin: 0 30px;
        line-height: 60px;
        font-size: 24px;
        color: #fff;
    }
    .header_menu{
        float: right;
        margin-right: 20px;
    }

</style>
<script>
    export default{
        data() {
            return {
                app_name: '博客后台',
                username: 'username'
            }
        },
        methods: {
            handleSelect(key, keyPath){
                if (key == 'logout') {
                    window.location.href="/logout"
                } else {
                    this.$router.push(key);
                }
            }
        }
    }
</script>
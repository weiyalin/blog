<template>
    <div>
        <el-menu :default-active = "current" :default-openeds = "opened" :unique-opened = "is_alone"
                 :router="true" class="my_menu menu" :collapse="isCollapse">
            <li class="el-menu-item menu_change_h" @click="change_menu"
                style="padding-left: 20px;text-align: -webkit-center;height: 40px;line-height: 40px;">
                <i class="ion-navicon-round" :class = "{ rorate : !isCollapse }" style="font-size: 19px;"></i>
            </li>
            <el-submenu v-for="menu in menus" :index.sync="menu.path" :router="true" :key = "menu.id">
                <template slot="title">
                    <i :class="menu.icon" class="menu-icon"></i>
                    <span slot="title">{{ menu.name }}</span>
                </template>
                <el-menu-item v-for="item in menu.children" :index.sync="item.path" :key = "item.id">
                    <i :class="item.icon" class="menu-icon"></i>
                    <span>{{ item.name }}</span>
                </el-menu-item>
            </el-submenu>
        </el-menu>
    </div>

</template>
<style scoped>
    .rorate:before {
        transform: rotate(90deg);
        -ms-transform: rotate(90deg);
        -moz-transform: rotate(90deg);
        -webkit-transform: rotate(90deg);
        -o-transform: rotate(90deg);
    }
    .menu-icon{
        padding-left: 5px;
        padding-right: 5px;
        font-size: 20px;
    }
    .menu_change_h {
        background-color: rgb(220, 235, 228);
    }

    .menu_change_h:hover {
        background-color: rgb(200, 223, 214);
    }
    .menu{
        transition: 0s;
    }
    .my_menu:not(.el-menu--collapse) {
        text-align: left;
        width: 200px;
    }
</style>
<script>
    export default{
        data(){
            return {
                menus: [],
                current: "",
                is_alone: false,
                opened: [],
                isCollapse: false
            }
        },
        methods: {
            getMenu(){
                var self = this;
                self.current = self.$route.path
                self.$http.get('/get_menu').then(function (res) {
                    self.menus = res.data.result;
                    for (var i = 0; i < self.menus.length; i++) {
                        if (window.location.hash.indexOf(self.menus[i].path) >= 0) {
                            self.opened.push(self.menus[i].path);
                        }
                    }
                }, function () {
                })
            },
            change_menu(){
                if (this.isCollapse === true){
                    this.isCollapse = false;
                    $(".page-content").css('margin-left', '200px');
                }
                else{
                    this.isCollapse = true;
                    $(".page-content").css('margin-left', '64px');
                }
            }
        },
        created(){
            this.getMenu();
        },
    }
</script>


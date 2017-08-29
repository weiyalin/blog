<template>
    <div>
        <el-menu :default-active="current" :default-openeds="opened"
                 :router="true" class="my_menu menu" :collapse="isCollapse">
            <li class="el-menu-item menu_change_h" @click="change_menu"
                style="height: 40px;line-height: 40px;">
            </li>
            <el-submenu v-for="menu in menus" :index.sync="menu.path" :router="true" :key = "menu.id">
                <template slot="title">
                    <i :class="menu.icon"></i>
                    <span slot="title">{{ menu.name }}</span>
                </template>
                <el-menu-item v-for="item in menu.children" :index.sync="item.path" :key = "item.id">
                    <i :class="item.icon"></i>
                    <span>{{ item.name }}</span>
                </el-menu-item>
            </el-submenu>
        </el-menu>
    </div>
</template>
<style scoped>

    .menu_change_h {
        background-color: rgb(220, 235, 228);
    }

    .menu_change_h:hover {
        background-color: rgb(200, 223, 214);
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
                opened: [],
                isCollapse: false
            }
        },
        methods: {
            getMenu(){
                var self = this;
                self.current = self.$route.path
                self.$http.get('/get_menu').then(function (res) {
                        console.log(res);
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
                if (this.isCollapse === true)
                    this.isCollapse = false;
                else
                    this.isCollapse = true;
            }
        },
        created(){
            this.getMenu();
        },
    }
</script>


<template>
    <div>
        <pageHeader></pageHeader>
        <div class="page-menu">
            <pageMenu></pageMenu>
        </div>
        <div class="page-content">
            <div style="padding:10px 20px 35px;background-color:#fff;">
                <router-view></router-view>
            </div>
            <div style="clear:both;"></div>
        </div>
    </div>
</template>

<script>
    import pageHeader from './components/layout/header.vue'
    import pageMenu from './components/layout/menu.vue'
    export default{
        components: {
            pageHeader,
            pageMenu
        }
    }
</script>

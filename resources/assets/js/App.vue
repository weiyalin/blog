<template>
    <div class="full">
        <pageHeader></pageHeader>
        <div class="main clear_both">
            <div class="page-menu">
                <div class="page-menu-background">
                    <pageMenu></pageMenu>
                </div>
            </div>
            <div class="page-content">
                <router-view></router-view>
            </div>
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

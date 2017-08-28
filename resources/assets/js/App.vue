<template>
    <div>
        <pageHeader></pageHeader>

        <pageMenu></pageMenu>

        <router-view></router-view>
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

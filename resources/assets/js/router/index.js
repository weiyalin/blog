import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter);

export default new VueRouter({
    saveScrollPosition: true,
    routes: [
        {
            path: '/index',
            component: resolve =>void(require(['../components/layout/menu.vue'], resolve))
        },
        {
            path: '/article/create_article',
            component: resolve =>void(require(['../components/article/create_article.vue'], resolve))
        },
        {
            path: '/article/article_manage',
            component: resolve =>void(require(['../components/article/article_manage.vue'], resolve))
        },
        {
            path: '/article/genre_manage',
            component: resolve =>void(require(['../components/article/genre_manage.vue'], resolve))
        },
        {
            path: '/article/comment_manage',
            component: resolve =>void(require(['../components/article/comment_manage.vue'], resolve))
        },
        {
            path: '/article/drafts',
            component: resolve =>void(require(['../components/article/drafts.vue'], resolve))
        },
        {
            path: '/article/recycle_bin',
            component: resolve =>void(require(['../components/article/recycle_bin.vue'], resolve))
        },
        {
            path: '/album/album_manage',
            component: resolve =>void(require(['../components/album/album_manage.vue'], resolve))
        },
        {
            path: '/album/upload',
            component: resolve =>void(require(['../components/album/upload.vue'], resolve))
        },
        {
            path: '/config/config_manage',
            component: resolve =>void(require(['../components/config/config_manage.vue'], resolve))
        },
        {
            path: '/user/user_manage',
            component: resolve =>void(require(['../components/user/user_manage.vue'], resolve))
        },
    ]
})
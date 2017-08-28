import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter);

export default new VueRouter({
    saveScrollPosition: true,
    routes: [
        {
            name: 'index',
            path: '/index',
            component: resolve =>void(require(['../components/layout/menu.vue'], resolve))
        }
    ]
})
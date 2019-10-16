import App from './App.vue';
import './bootstrap';
import Vue from 'vue';
import VueRouter from 'vue-router';
import { routes } from './routes.js';

import { SSL_OP_SSLEAY_080_CLIENT_DH_BUG } from 'constants';

window.Vue = Vue;

Vue.use(VueRouter);


const router = new VueRouter({
    mode:'history',
    routes
})

Vue.filter('truncate', function (value) {
    if(value.length > 40){
        return value.slice(0,40) + '...';
    } else {
        return value;
    }
  })

const app = new Vue({
    el: '#app',
    router,
    render: h => h(App)
});

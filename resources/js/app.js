import App from './App.vue';
import './bootstrap';
import Vue from 'vue';
import { SSL_OP_SSLEAY_080_CLIENT_DH_BUG } from 'constants';

window.Vue = Vue;

Vue.filter('truncate', function (value) {
    if(value.length > 15){
        return value.slice(0,15) + '...';
    } else {
        return value;
    }
  })

const app = new Vue({
    el: '#app',
    render: h => h(App)
});

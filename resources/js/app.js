import App from './App.vue';
import './bootstrap';
import Vue from 'vue';

window.Vue = Vue;

const app = new Vue({
    el: '#app',
    render: h => h(App)
});

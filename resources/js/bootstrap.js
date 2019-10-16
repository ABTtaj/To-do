import moment from 'moment';
import Vue from 'vue';

window._ = require('lodash');

window.event = new Vue();

window.moment=moment;

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.flash = (mode,message)=>{
    window.event.$emit('flash',{
        mode,
        message
    });
}
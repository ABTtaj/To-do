<template>
    <div>
        <app-header></app-header>
        <div class="container my-5">
            <router-view></router-view>
        </div>
        <loader></loader>
        <flash-message></flash-message>
    </div>
</template>
<script>
import Header from './components/Header.vue';
import FlashMessage from './components/helpers/FlashMessage.vue';
import Loader from './components/helpers/Loader.vue';
export default {
    components:{
        appHeader : Header,
        FlashMessage,
        Loader
    }
}
</script>
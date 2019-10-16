<template>
<div class="loader-container" v-if="show">
    <div class="loader"></div>
</div>
</template>
<script>
export default {
    data(){
        return {
            show:true
        }
    },
    created(){
        window.event.$on('dataFetched',()=>{
            this.show=false;
        })
        window.event.$on('pageBeforeCreate',()=>{
            this.show=true;
        })
    }
}
</script>
<style scoped>
    .loader-container{
        background: white;
        width: 100%;
        height: 100%;
        position: fixed;
        top: 0;
    }
    .loader {
    border: 10px solid #f8f9fa; /* Light grey */
    border-top: 10px solid #343a40; /* Dark */
    border-radius: 50%;
    width: 60px;
    height: 60px;
    animation: spin 2s linear infinite;
    position: fixed;
    z-index: 10000;
    left: 50%;
    top: 50%;
    margin-top: -30px;
    margin-left: -30px;
    }

    @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
    }
</style>